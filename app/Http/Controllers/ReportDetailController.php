<?php

namespace App\Http\Controllers;

use App\Exports\OrderExport;
use App\Helpers\Helper;
use App\Interfaces\OrderInterface;
use App\Models\Ulp;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportDetailController extends Controller
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
                'create' => 'Detail-Detail Tambah',
                'update' => 'Detail-Detail Edit',
                'delete' => 'Detail-Detail Hapus',
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

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Laporan"],
            ["link" => "#", "name" => "Detail"],
        ];

        return view('pages.report.details.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'up3s',
            ])
        );
    }
    function list(Request $request) {
        $resources = $this->detailRepo->list_detail($request);

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/report/detail",
            "Detail",
            ['detail'],
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
                'create' => 'Detail-Detail Tambah',
                'detail' => 'Detail-Detail Lihat',
                'update' => 'Detail-Detail Edit',
                'delete' => 'Detail-Detail Hapus',
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
                "name" => "Detail",
            ],
        ];

        list($order) = $this->detailRepo->show($id, $request);

        return view('pages.report.details.detail')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'order',
            ])
        );
    }

    public function export($up3_id, $ulp_id, $start_date, $end_date)
    {
        if ($up3_id && $ulp_id == '-') {
            $up3 = Up3::find($up3_id);
            $filename = 'UP3 ' . $up3->name . " Order.xlsx";
        } else {
            $ulp = Ulp::find($ulp_id);
            $filename = 'ULP ' . $ulp->name . " Order.xlsx";
        }

        return Excel::download(new OrderExport($up3_id, $ulp_id, $start_date, $end_date), $filename);
    }
}
