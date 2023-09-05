<?php

namespace App\Http\Controllers;

use App\Exports\UserUploadFailedExport;
use App\Exports\PetugasUploadExport;
use App\Helpers\Helper;
use App\Http\Requests\PetugasRequest;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PetugasController extends Controller
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
                'create' => 'Petugas-Petugas Tambah',
                'update' => 'Petugas-Petugas Edit',
                'delete' => 'Petugas-Petugas Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Petugas"],
        ];

        return view('pages.master-data.petugas.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }

    function list(Request $request)
    {
        $status = 'Petugas';
        $resources = $this->userRepo->list($status);

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/petugass",
            "Petugas",
            ['reset-password'],
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
                "link" => "master-data/petugass",
                "name" => "Petugas",
            ],
            [
                "name" => "Tambah",
            ],
        ];

        list($uids) = $this->userRepo->create();

        return view('pages.master-data.petugas.create')->with(
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
    public function store(PetugasRequest $request)
    {
        $this->userRepo->store_petugas($request);
            return redirect('/master-data/petugass')->with(['status' => 200]);
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
                'create' => 'Petugas-Petugas Tambah',
                'update' => 'Petugas-Petugas Edit',
                'delete' => 'Petugas-Petugas Hapus',
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
                "link" => "master-data/petugass",
                "name" => "Petugas",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($petugas, $uids) = $this->userRepo->edit_petugas($id);

        return view('pages.master-data.petugas.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'petugas',
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
    public function update(PetugasRequest $request, $id)
    {

        $this->userRepo->update_petugas($request, $id);
        return redirect('/master-data/petugass')->with(['status' => 200]);
    }

    public function listSelect(Request $request)
    {

        $data = User::select('id', 'name AS text')
            ->where('ulp_id', $request->ulp_id)
            ->where('type', 'ULP')
            ->get();

        return response()->json($data);
    }

    public function reset_password($id)
    {
        $this->userRepo->reset_password($id);
        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = User::find($id);

        if (\File::exists(public_path('images/upload/' . $row->photo))) {
            \File::delete(public_path('images/upload/' . $row->photo));
        }

        User::find($id)->delete();
        return response()->json(['status' => 200]);
    }

    public function download()
    {
        return response()->download(public_path('excel/Template Petugas.xlsx'));
    }

    public function upload(Request $request)
    {
        return $this->userRepo->upload_petugas($request);
    }

    public function export_petugas()
    {
        $status = 'Petugas';
        $filename = "Daftar Petugas.xlsx";
        return Excel::download(new PetugasUploadExport($status), $filename);
    }

    public function export()
    {
        $filename = "Daftar petugas gagal upload.xlsx";
        return Excel::download(new UserUploadFailedExport(), $filename);
    }
}
