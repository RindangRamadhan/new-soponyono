<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\UidRequest;
use App\Interfaces\UidInterface;
use App\Models\Uid;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UidController extends Controller
{
    protected $uidRepo;

    public function __construct(UidInterface $uidRepo)
    {
        $this->uidRepo = $uidRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;

        $isCreate = false;
        if ($tipe == 'ALL') {
            $isCreate = true;
        }
        $pageConfigs = [
            'pageHeader' => true,
            'isReload' => true,
            'isCreate' => $isCreate,
            'permission' => [
                'create' => 'Uid-Uid Tambah',
                'update' => 'Uid-Uid Edit',
                'delete' => 'Uid-Uid Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Uid"],
        ];

        return view('pages.master-data.uids.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    function list(Request $request)
    {

        $resources = $this->uidRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/uids",
            "Uid",
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
                'create' => 'Uid-Uid Tambah',
                'update' => 'Uid-Uid Edit',
                'delete' => 'Uid-Uid Hapus',
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
                "link" => "master-data/uids",
                "name" => "Uid",
            ],
            [
                "name" => "Tambah",
            ],
        ];

        return view('pages.master-data.uids.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UidRequest $request)
    {
        $this->uidRepo->store($request);
        return redirect('/master-data/uids')->with(['status' => 200]);
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
                'create' => 'Uid-Uid Tambah',
                'update' => 'Uid-Uid Edit',
                'delete' => 'Uid-Uid Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "name" => "Uid",
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
                'create' => 'Uid-Uid Tambah',
                'update' => 'Uid-Uid Edit',
                'delete' => 'Uid-Uid Hapus',
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
                "link" => "master-data/uids",
                "name" => "Uid",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($uid) = $this->uidRepo->edit($id);

        return view('pages.master-data.uids.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'uid',
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
    public function update(UidRequest $request, $id)
    {
        $this->uidRepo->update($request, $id);
        return redirect('/master-data/uids')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Uid::find($id)->delete();
        return response()->json(['status' => 200]);
    }
}
