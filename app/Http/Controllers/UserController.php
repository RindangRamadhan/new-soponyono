<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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

        $user = User::select('users.*', 'r.id AS role_id', 'r.name AS role_name')
            ->join('model_has_roles AS mhr', 'users.id', 'mhr.model_id')
            ->join('roles AS r', 'mhr.role_id', 'r.id')
            ->leftJoin('sub_work_units AS swu', 'users.sub_work_unit_id', 'swu.id')
            ->where('users.id', Auth::user()->id)
            ->first();

        $roles = Role::select('id', 'name as text')->get();
        $types = Helper::UserType();

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
}
