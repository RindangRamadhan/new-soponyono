<?php

namespace App\Http\Controllers;

use App\Exports\ReportDailyExport;
use App\Interfaces\OrderInterface;
use App\Models\Up3;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ReportDailyController extends Controller
{

    public function __construct(OrderInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
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
                'create' => 'Harian-Harian Tambah',
                'update' => 'Harian-Harian Edit',
                'delete' => 'Harian-Harian Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Laporan"],
            ["link" => "#", "name" => "Harian"],
        ];

        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $months[] = [
                "id" => $m,
                "text" => date('F', mktime(0, 0, 0, $m, 1, date('Y'))),
            ];
        }

        $user = Auth::user();
        $tipe = $user->type;
        if ($tipe == 'UP3' || $tipe == 'ULP') {
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $user->up3_id)
                ->get();
        } else {
            $up3s = Up3::select('id', 'name AS text')
                ->where('uid_id', $user->uid_id)
                ->get();
        }

        return view('pages.report.daily.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'months',
                'up3s',
            ])
        );
    }

    function list(Request $request) {
        $resources = $this->orderRepo->report_daily($request);

        $data = [];
        foreach ($resources as $resource) {
            if ($resource->id) {
                $obj = [
                    'id' => $resource->id,
                    'name' => $resource->name,
                ];

                for ($d = 1; $d <= 20; $d++) {
                    if ($resource->day == $d) {
                        $obj["total_paid_$d"] = $resource->total_paid;
                        $obj["total_debt_$d"] = $resource->total_debt;
                    } else {
                        $obj["total_paid_$d"] = 0;
                        $obj["total_debt_$d"] = 0;
                    }
                }

                $data[] = $obj;
            }
        }

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $resources = $this->orderRepo->report_daily($request);

        $reports = [];
        foreach ($resources as $resource) {
            if ($resource->id) {
                $obj = [
                    'id' => $resource->id,
                    'name' => $resource->name,
                ];

                for ($d = 1; $d <= 20; $d++) {
                    if ($resource->day == $d) {
                        $obj["total_paid_$d"] = $resource->total_paid;
                        $obj["total_debt_$d"] = $resource->total_debt;
                    } else {
                        $obj["total_paid_$d"] = 0;
                        $obj["total_debt_$d"] = 0;
                    }
                }

                $reports[] = $obj;
            }
        }

        switch ($request->doc_type) {
            case 'pdf':
                $doc = Pdf::loadView('pages.report.daily.export', ['reports' => $reports])
                    ->setPaper('a4', 'landscape');

                return $doc->download("Laporan Harian.pdf");
                break;
            case 'excel':
                return Excel::download(new ReportDailyExport($reports), 'Laporan Harian.xlsx');
                break;
        }
    }
}
