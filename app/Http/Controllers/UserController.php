<?php

namespace App\Http\Controllers;

use App\Exports\UserUploadFailedExport;
use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isReload' => true,
            'isCreate' => true,
            'permission' => [
                'create' => 'Pengguna-Pengguna Tambah',
                'update' => 'Pengguna-Pengguna Edit',
                'delete' => 'Pengguna-Pengguna Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Pengguna"],
        ];

        return view('pages.master-data.users.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    function list(Request $request) {
        $resources = $this->userRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request, $resources, "/master-data/users", "Pengguna",
        );

        $result = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $records,
        ];

        return json_encode($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'isSave' => true,
            'permission' => [
                'create' => 'Pengguna-Pengguna Tambah',
                'update' => 'Pengguna-Pengguna Edit',
                'delete' => 'Pengguna-Pengguna Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Master Data",
            ],
            [
                "link" => "master-data/users",
                "name" => "Pengguna",
            ],
            [
                "name" => "Tambah",
            ],
        ];

        list($uids, $roles, $types) = $this->userRepo->create();

        return view('pages.master-data.users.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'roles',
                'types',
                'uids',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->userRepo->store($request);
        return redirect('/master-data/users')->with(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'permission' => [
                'create' => 'Pengguna-Pengguna Tambah',
                'update' => 'Pengguna-Pengguna Edit',
                'delete' => 'Pengguna-Pengguna Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "name" => "Profile",
            ],
        ];

        list($user, $roles, $types) = $this->userRepo->show($id);

        return view('pages.profile.index')->with(compact([
            'pageConfigs',
            'breadcrumbs',
            'user',
            'roles',
            'types',
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'isSave' => true,
            'permission' => [
                'create' => 'Pengguna-Pengguna Tambah',
                'update' => 'Pengguna-Pengguna Edit',
                'delete' => 'Pengguna-Pengguna Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Master Data",
            ],
            [
                "link" => "master-data/users",
                "name" => "Pengguna",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($user, $uids, $roles, $types) = $this->userRepo->edit($id);

        return view('pages.master-data.users.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'user',
                'uids',
                'roles',
                'types',
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->userRepo->update($request, $id);
        return redirect('/master-data/users')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json(['status' => 200]);
    }

    public function download()
    {
        return response()->download(public_path('excel/Template Pengguna.xlsx'));
    }

    public function upload(Request $request)
    {
        return $this->userRepo->upload($request);
    }

    public function export()
    {
        $filename = "Daftar pengguna gagal upload.xlsx";
        return Excel::download(new UserUploadFailedExport(), $filename);
    }

    // ? ------------------------------------------------ PROFILE ------------------------------------------------

    public function editPass()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'isSave' => true,
            'permission' => [
                'create' => 'Pengguna-Pengguna Tambah',
                'update' => 'Pengguna-Pengguna Edit',
                'delete' => 'Pengguna-Pengguna Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "name" => "Ubah Password",
            ],
        ];

        $user = User::find(Auth::user()->id);

        return view('pages.profile.change-password')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'user',
            ])
        );
    }

    public function updateProfile(Request $request, $id)
    {
        $this->validate($request, [
            'user_name' => 'required|unique:users,user_name,' . $id,
            'name' => 'required',
        ]);

        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'user_name' => $request->user_name,
        ]);

        return redirect("/users/$id/profile")->with(['status' => 200]);
    }

    public function updatePass(Request $request, $id)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|string|min:8',
        ]);

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
            return redirect()->back()->with(['status' => 500, "message" => "Kata Sandi saat ini tidak cocok dengan Kata Sandi yang Anda berikan."]);
        }

        if (strcmp($request->current_password, $request->password) == 0) {
            return redirect()->back()->with(['status' => 500, "message" => "Kata Sandi Baru tidak boleh sama dengan Kata Sandi Anda saat ini."]);
        }

        $user = User::find($id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with(["status" => 200, "message" => "Password Berhasil Diubah."]);
    }
}
