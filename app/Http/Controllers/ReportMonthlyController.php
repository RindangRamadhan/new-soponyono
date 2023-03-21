<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderInterface;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportMonthlyController extends Controller
{

    protected $detailRepo;

    public function __construct(OrderInterface $detailRepo)
    {
        $this->detailRepo = $detailRepo;
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
            'isCreate' => false,
            'permission' => [
                'create' => 'Bulanan-Bulanan Tambah',
                'update' => 'Bulanan-Bulanan Edit',
                'delete' => 'Bulanan-Bulanan Hapus',
            ],
        ];

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'UP3' || $tipe == 'ULP') {
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $rowuser->up3_id)
                ->get();
        } else {
            $up3s = Up3::select('id', 'name AS text')
                ->where('uid_id', $rowuser->uid_id)
                ->get();
        }

        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = [
                "id" => $m,
                "text" => date('F', mktime(0, 0, 0, $m, 1, date('Y'))),
            ];
        }

        $years = [];
        for ($y = 2023; $y <= 2033; $y++) {
            $years[] = [
                "id" => $y,
                "text" => $y,
            ];
        }

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Laporan"],
            ["link" => "#", "name" => "Bulanan"],
        ];

        return view('pages.report.monthlys.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'up3s',
                'months',
                'years',
            ])
        );
    }
    function list(Request $request) {
        $resources = $this->detailRepo->list_monthly($request);
        return response()->json($resources);
    }


}
