<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ManagerUlpRequest;
use App\Interfaces\ManagerUlpInterface;
use App\Models\ManagerUlp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerUlpController extends Controller
{
    protected $managerUlpRepo;

    public function __construct(ManagerUlpInterface $managerUlpRepo)
    {
        $this->managerUlpRepo = $managerUlpRepo;
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
                'create' => 'Manager Ulp-Manager Ulp Tambah',
                'update' => 'Manager Ulp-Manager Ulp Edit',
                'delete' => 'Manager Ulp-Manager Ulp Hapus',
            ],
        ];
        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Manager Ulp"],
        ];

        return view('pages.master-data.manager-ulps.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }


    function list(Request $request)
    {
        $resources = $this->managerUlpRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/manager-ulps",
            "Manager Ulp",
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
                'create' => 'Manager Ulp-Manager Ulp Tambah',
                'update' => 'Manager Ulp-Manager Ulp Edit',
                'delete' => 'Manager Ulp-Manager Ulp Hapus',
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
                "link" => "master-data/manager-ulps",
                "name" => "Manager Ulp",
            ],
            [
                "name" => "Tambah",
            ],
        ];
        
        list($ulps) = $this->managerUlpRepo->create();
        return view('pages.master-data.manager-ulps.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'ulps',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ManagerUlpRequest $request)
    {
        
        $this->managerUlpRepo->store($request);
        return redirect('/master-data/manager-ulps')->with(['status' => 200]);
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
                'create' => 'Manager Ulp-Manager Ulp Tambah',
                'update' => 'Manager Ulp-Manager Ulp Edit',
                'delete' => 'Manager Ulp-Manager Ulp Hapus',
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
                "link" => "master-data/manager-ulps",
                "name" => "Manager Ulp",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($manager_ulp, $ulps) = $this->managerUlpRepo->edit($id);

        return view('pages.master-data.manager-ulps.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'manager_ulp',
                'ulps',
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
    public function update(ManagerUlpRequest $request, $id)
    {
        $this->managerUlpRepo->update($request, $id);
        return redirect('/master-data/manager-ulps')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ManagerUlp::find($id)->delete();
        return response()->json(['status' => 200]);
    }
}
