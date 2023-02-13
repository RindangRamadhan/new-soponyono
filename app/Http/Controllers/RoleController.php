<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\RoleRequest;
use App\Interfaces\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $roleRepo;

    public function __construct(RoleInterface $roleRepo)
    {
        $this->roleRepo = $roleRepo;
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
                'create' => 'Hak Akses-Hak Akses Tambah',
                'update' => 'Hak Akses-Hak Akses Edit',
                'delete' => 'Hak Akses-Hak Akses Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Lainnya"],
            ["link" => "#", "name" => "Hak Akses"],
        ];

        return view('pages.master-data.roles.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    function list(Request $request) {
        $resources = $this->roleRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request, $resources, "/master-data/roles", "Hak Akses",
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
                'create' => 'Hak Akses-Hak Akses Tambah',
                'update' => 'Hak Akses-Hak Akses Edit',
                'delete' => 'Hak Akses-Hak Akses Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Lainnya"],
            ["link" => "master-data/roles", "name" => "Hak Akses"],
            ["name" => "Tambah"],
        ];

        $permissions = $this->roleRepo->create();
        return view('pages.master-data.roles.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'permissions',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $this->roleRepo->store($request);
        return redirect('/master-data/roles')->with(['status' => 200]);
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
                'create' => 'Hak Akses-Hak Akses Tambah',
                'update' => 'Hak Akses-Hak Akses Edit',
                'delete' => 'Hak Akses-Hak Akses Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Lainnya"],
            ["link" => "master-data/roles", "name" => "Hak Akses"],
            ["name" => "Edit"],
        ];

        list($role, $permissions, $selectedPermissions) = $this->roleRepo->edit($id);

        return view('pages.master-data.roles.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'role',
                'permissions',
                'selectedPermissions',
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
    public function update(RoleRequest $request, $id)
    {
        $this->roleRepo->update($request, $id);
        return redirect('/master-data/roles')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->roleRepo->destroy($id);
    }
}
