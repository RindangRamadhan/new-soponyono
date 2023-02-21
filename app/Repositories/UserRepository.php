<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Imports\UserImport;
use App\Interfaces\UserInterface;
use App\Models\Uid;
use App\Models\Ulp;
use App\Models\Up3;
use App\Models\User;
use App\Models\UserUploadFailed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserRepository implements UserInterface
{
    function list()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;

        $user = User::select(
            'users.id',
            'users.id AS users__id',
            'users.user_name',
            'users.rbm_code',
            'users.name AS users__name',
            'users.type AS users__type',
            'uid.name AS uid__name',
            'up3.name AS up3__name',
            'ulp.name AS ulp__name',
            'r.name AS r__name',
        )
            ->join('uids AS uid', 'users.uid_id', 'uid.id')
            ->join('up3s AS up3', 'users.up3_id', 'up3.id')
            ->join('ulps AS ulp', 'users.ulp_id', 'ulp.id')
            ->join('model_has_roles AS mhr', 'users.id', 'mhr.model_id')
            ->join('roles AS r', 'mhr.role_id', 'r.id');;
        if ($tipe == 'UP3') {
            $data = $user->where([
                    ['users.up3_id', $rowuser->up3_id],
                ])->where(function ($query) {
                    $query->where('type', 'UP3')
                        ->orWhere('type', 'ULP');
                });
        } else if ($tipe == 'ULP') {
            $data = $user->where([
                    ['users.ulp_id', $rowuser->ulp_id],
                    ['type', '=', 'ULP'],
                ]);
        } else if ($tipe == 'ALL') {
            $data = $user;
        } else {
            $data = $user->where([
                    ['users.uid_id', $rowuser->uid_id],
                ]);
        }

        return $data;
    }

    public function create()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $rowuser->uid_id],
            ])->get();
        }

        $roles = Role::select('id', 'name as text')->get();
        $types = Helper::UserType($tipe);
        return [$uids, $roles, $types];
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'user_name' => $request->user_name,
            'rbm_code' => $request->rbm_code,
            'name' => $request->name,
            'type' => $request->type,
            'phone' => $request->phone,
            'position' => $request->position,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::find($request->role_id);

        $user->assignRole($role);
    }

    public function show($id)
    {
        $user = User::select(
            'users.*',
            'uid.name AS uid_name',
            'up3.name AS up3_name',
            'ulp.name AS ulp_name',
            'r.id AS role_id',
            'r.name AS role_name'
        )
            ->join('uids AS uid', 'users.uid_id', 'uid.id')
            ->join('up3s AS up3', 'users.up3_id', 'up3.id')
            ->join('ulps AS ulp', 'users.ulp_id', 'ulp.id')
            ->join('model_has_roles AS mhr', 'users.id', 'mhr.model_id')
            ->join('roles AS r', 'mhr.role_id', 'r.id')
            ->where('users.id', $id)
            ->first();

        $roles = Role::select('id', 'name as text')->get();
        $types = [];

        $rowuser = User::find(Auth::user()->id);
        if ($rowuser) {
            $tipe = $rowuser->type;
            $types = Helper::UserType($tipe);
        }

        return [$user, $roles, $types];
    }

    public function edit($id)
    {
        $user = User::select('users.*', 'r.id AS role_id')
            ->join('model_has_roles AS mhr', 'users.id', 'mhr.model_id')
            ->join('roles AS r', 'mhr.role_id', 'r.id')
            ->where('users.id', $id)
            ->first();

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $rowuser->uid_id],
            ])->get();
        }

        $roles = Role::select('id', 'name as text')->get();
        $types = Helper::UserType($tipe);

        return [$user, $uids, $roles, $types];
    }

    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $role = Role::find($request->role_id);

        $user->update([
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'user_name' => $request->user_name,
            'rbm_code' => $request->rbm_code,
            'name' => $request->name,
            'type' => $request->type,
        ]);

        DB::table('model_has_roles')->where("model_id", $user->id)->delete();

        $user->assignRole($role);
    }

    public function reset_password($id)
    {
        $user = User::find($id);

        $user->update([
            'password' => Hash::make("12345678"),
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // Get file excel from requests
        $file = $request->file('file');

        // Convert Excel to Array
        $excels = Excel::toArray(new UserImport, $file);

        DB::beginTransaction();

        try {
            $upload_succeed = 0;
            $upload_faileds = [];

            foreach ($excels[0] as $k => $v) {
                // Skip Header
                if ($k == 0) {
                    continue;
                }

                $upload_failed = [
                    'user_name' => $v[0],
                    'rbm_code' => $v[1],
                    'name' => $v[2],
                    'phone' => $v[3],
                    'type' => $v[4],
                    'position' => $v[5],
                    'uid_id' => $v[6],
                    'up3_id' => $v[7],
                    'ulp_id' => $v[8],
                    'role' => $v[9],
                ];

                if ($v[0]) {
                    $upload_succeed++;
                    $user_name = User::select('id')->where('user_name', $v[0])->count();
                    if ($user_name > 0) {
                        $upload_failed['reason'] = "User name sudah ada";
                        $upload_faileds[] = $upload_failed;
                        continue;
                    }

                    $uid = Uid::select('id')->where('id', $v[6]);
                    if ($uid->count() == 0) {
                        $upload_failed['reason'] = "UID tidak ditemukan";
                        $upload_faileds[] = $upload_failed;
                        continue;
                    }

                    $up3 = Up3::select('id')->where('id', $v[7]);
                    if ($up3->count() == 0) {
                        $upload_failed['reason'] = "UP3 tidak ditemukan";
                        $upload_faileds[] = $upload_failed;
                        continue;
                    }

                    $ulp = Ulp::select('id')->where('id', $v[8]);
                    if ($ulp->count() == 0) {
                        $upload_failed['reason'] = "ULP tidak ditemukan";
                        $upload_faileds[] = $upload_failed;
                        continue;
                    }

                    $role = $this->roleMap($v[9]);
                    if ($role == 0) {
                        $userFailed['reason'] = "Hak akses tidak ditemukan";
                        $userFaileds[] = $userFailed;
                        continue;
                    }

                    $user = User::create([
                        'user_name' => $v[0],
                        'rbm_code' => $v[1],
                        'name' => $v[2],
                        'phone' => $v[3],
                        'type' => $v[4],
                        'position' => $v[5],
                        'uid_id' => $v[6],
                        'up3_id' => $v[7],
                        'ulp_id' => $v[8],
                        'password' => Hash::make("12345678"),
                    ]);

                    $newRole = Role::find($role);
                    $user->assignRole($newRole);
                }
            }

            if (count($upload_faileds) > 0) {
                UserUploadFailed::query()->delete();
                UserUploadFailed::insert($upload_faileds);
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json([
            'status' => 200,
            'user_upload' => $upload_succeed,
            'user_failed' => count($upload_faileds),
        ]);
    }

    public function roleMap($code)
    {
        $code = strtoupper($code);

        $role = [
            "U1" => 1, // Super Admin
            "U2" => 2, // Pengguna
        ];

        return $role[$code] ?? 0;
    }
}
