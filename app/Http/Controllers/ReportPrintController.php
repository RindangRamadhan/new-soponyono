<?php

namespace App\Http\Controllers;


use App\Exports\OrderExport;
use App\Helpers\Helper;
use App\Interfaces\OrderInterface;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportPrintController extends Controller
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
                'create' => 'Cetak-Cetak Tambah',
                'update' => 'Cetak-Cetak Edit',
                'delete' => 'Cetak-Cetak Hapus',
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
            ["link" => "#", "name" => "Cetak"],
        ];

        return view('pages.report.prints.index')->with(
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
        $resources = $this->detailRepo->list_print($request);

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/report/print",
            "Cetak",
            ['detail','print'],
            ['delete', 'edit'],
        );

        $result = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $records,
        ];

        return json_encode($result);
    }

    public function show($id, Request $request)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'permission' => [
                'create' => 'Cetak-Cetak Tambah',
                'detail' => 'Cetak-Cetak Lihat',
                'update' => 'Cetak-Cetak Edit',
                'delete' => 'Cetak-Cetak Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Laporan",
            ],
            [
                "name" => "Cetak",
            ],
        ];

        list($order) = $this->detailRepo->show($id);

        return view('pages.report.prints.detail')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'order',
            ])
        );
    }

    public function print($id)
    {
        $filename = "Order.xlsx";
        return $filename.' ID'. $id;
    }

    public function print_all($user_id, $month, $year)
    {
        $filename = "cetak.xlsx";
        return $filename;
    }

}
