<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\Uid;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    function list()
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
        $data = [];
        if ($tipe == 'UP3') {
            $idup3 = $rowuser->up3_id;

            $data = User::select(
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
                ->join('roles AS r', 'mhr.role_id', 'r.id')
                ->where([
                    ['users.up3_id', $idup3]
                ])->where(function ($query) {
                    $query->where('type', 'UP3')
                        ->orWhere('type', 'ULP');
                });
        } else if ($tipe == 'ULP') {
            $idulp = $rowuser->ulp_id;

            $data = User::select(
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
                ->join('roles AS r', 'mhr.role_id', 'r.id')
                ->where([
                    ['users.ulp_id', $idulp],
                    ['type', '=', 'ULP'],
                ]);
        } else {
            $data = User::select(
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
                ->join('roles AS r', 'mhr.role_id', 'r.id');
        }

        return $data;
    }

    public function create()
    {
        $uids = Uid::select('id', 'name as text')->get();
        $roles = Role::select('id', 'name as text')->get();
        $types = [];

        $rowuser = User::find(Auth::user()->id);
        if ($rowuser) {
            $tipe = $rowuser->type;
            $types = Helper::UserType($tipe);
        }

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

        $uids = Uid::select('id', 'name as text')->get();

        $roles = Role::select('id', 'name as text')->get();
        $types = [];

        $rowuser = User::find(Auth::user()->id);
        if ($rowuser) {
            $tipe = $rowuser->type;
            $types = Helper::UserType($tipe);
        }
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
}
