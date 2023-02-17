<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\Up3Request;
use App\Interfaces\Up3Interface;
use App\Models\Up3;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Up3Controller extends Controller
{
    protected $up3Repo;

    public function __construct(Up3Interface $up3Repo)
    {
        $this->up3Repo = $up3Repo;
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
                'create' => 'Up3-Up3 Tambah',
                'update' => 'Up3-Up3 Edit',
                'delete' => 'Up3-Up3 Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Up3"],
        ];

        return view('pages.master-data.up3s.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    function list(Request $request)
    {
        $resources = $this->up3Repo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/up3s",
            "Up3",
        );

        $result = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $records,
        ];



        return json_encode($result);
    }

    public function listSelect(Request $request)
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
        $data = [];
        if ($tipe == 'UP3' || $tipe == 'ULP') {
            $id_up3 = $rowuser->up3_id;
            $data = Up3::select('id', 'name AS text')
                ->where('id', $id_up3)
                ->get();
        } else {
            $data = Up3::select('id', 'name AS text')
                ->where('uid_id', $request->uid_id)
                ->get();
        }


        return response()->json($data);
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
                'create' => 'Up3-Up3 Tambah',
                'update' => 'Up3-Up3 Edit',
                'delete' => 'Up3-Up3 Hapus',
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
                "link" => "master-data/up3s",
                "name" => "Up3",
            ],
            [
                "name" => "Tambah",
            ],
        ];
        list($uids) = $this->up3Repo->create();
        return view('pages.master-data.up3s.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
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
    public function store(Up3Request $request)
    {
        $this->up3Repo->store($request);
        return redirect('/master-data/up3s')->with(['status' => 200]);
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
                'create' => 'Up3-Up3 Tambah',
                'update' => 'Up3-Up3 Edit',
                'delete' => 'Up3-Up3 Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "name" => "Up3",
            ],
        ];

        return view('pages.profile.index')->with(compact([
            'pageConfigs',
            'breadcrumbs',
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
                'create' => 'Up3-Up3 Tambah',
                'update' => 'Up3-Up3 Edit',
                'delete' => 'Up3-Up3 Hapus',
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
                "link" => "master-data/up3s",
                "name" => "Up3",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($up3, $uids) = $this->up3Repo->edit($id);

        return view('pages.master-data.up3s.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'up3',
                'uids',
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
    public function update(Up3Request $request, $id)
    {
        $this->up3Repo->update($request, $id);
        return redirect('/master-data/up3s')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Up3::find($id)->delete();
        return response()->json(['status' => 200]);
    }
}
