<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\UlpRequest;
use App\Interfaces\UlpInterface;
use App\Models\Ulp;
use Illuminate\Http\Request;

class UlpController extends Controller
{
    protected $ulpRepo;

    public function __construct(UlpInterface $ulpRepo)
    {
        $this->ulpRepo = $ulpRepo;
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
                'create' => 'Ulp-Ulp Tambah',
                'update' => 'Ulp-Ulp Edit',
                'delete' => 'Ulp-Ulp Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Ulp"],
        ];

        return view('pages.master-data.ulps.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }


    function list(Request $request)
    {
        $resources = $this->ulpRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/ulps",
            "Ulp",
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
       $data = Ulp::select('id', 'name AS text')
           ->where('up3_id', $request->up3_id)
           ->get();

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
                'create' => 'Ulp-Ulp Tambah',
                'update' => 'Ulp-Ulp Edit',
                'delete' => 'Ulp-Ulp Hapus',
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
                "link" => "master-data/ulps",
                "name" => "Ulp",
            ],
            [
                "name" => "Tambah",
            ],
        ];
        list($up3s) = $this->ulpRepo->create();
        return view('pages.master-data.ulps.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'up3s',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UlpRequest $request)
    {
        $this->ulpRepo->store($request);
        return redirect('/master-data/ulps')->with(['status' => 200]);
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
                'create' => 'Ulp-Ulp Tambah',
                'update' => 'Ulp-Ulp Edit',
                'delete' => 'Ulp-Ulp Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "name" => "Ulp",
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
                'create' => 'Ulp-Ulp Tambah',
                'update' => 'Ulp-Ulp Edit',
                'delete' => 'Ulp-Ulp Hapus',
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
                "link" => "master-data/ulps",
                "name" => "Ulp",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($rsdata,$up3s) = $this->ulpRepo->edit($id);
        
        return view('pages.master-data.ulps.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'rsdata',
                'up3s',
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
    public function update(UlpRequest $request, $id)
    {
        $this->ulpRepo->update($request, $id);
        return redirect('/master-data/ulps')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ulp::find($id)->delete();
        return response()->json(['status' => 200]);
    }
}
