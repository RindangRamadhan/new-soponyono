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
        $years = [];
        for ($y = 2023; $y <= 2033; $y++) {
            $years[] = [
                "id" => $y,
                "text" => $y,
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
                'years',
                'up3s',
                'tipe',
            ])
        );
    }

    function list(Request $request)
    {
        $resources = $this->orderRepo->report_daily($request);

        $data = [];
        foreach ($resources as $resource) {
            if ($resource->id) {
                $id = $resource->id;
                if (count($data) > 0) {
                    $rsTemp = array_filter(
                        $data,
                        function ($row1) use ($id) {
                            return  $row1['id']  == $id;
                        }
                    );
                    if (count($rsTemp) == 0) {
                        $obj = [
                            'id' => $resource->id,
                            'name' => $resource->name,
                        ];

                        for ($d = 1; $d <= 20; $d++) {
                            $rsTemp = array_filter(
                                $resources,
                                function ($row1) use ($id, $d) {
                                    return  $row1->id  == $id && $row1->day  == $d;
                                }
                            );

                            if (count($rsTemp) > 0) {
                                foreach ($rsTemp as $row) {
                                    $obj["total_paid_$d"] = $row->total_paid;
                                    $obj["total_debt_$d"] = $row->total_debt;
                                }
                            } else {
                                $obj["total_paid_$d"] = 0;
                                $obj["total_debt_$d"] = 0;
                            }
                        }

                        $data[] = $obj;
                    }
                } else {
                    $obj = [
                        'id' => $resource->id,
                        'name' => $resource->name,
                    ];

                    for ($d = 1; $d <= 20; $d++) {
                        $rsTemp = array_filter(
                            $resources,
                            function ($row1) use ($id, $d) {
                                return  $row1->id  == $id && $row1->day  == $d;
                            }
                        );

                        if (count($rsTemp) > 0) {
                            foreach ($rsTemp as $row) {
                                $obj["total_paid_$d"] = $row->total_paid;
                                $obj["total_debt_$d"] = $row->total_debt;
                            }
                        } else {
                            $obj["total_paid_$d"] = 0;
                            $obj["total_debt_$d"] = 0;
                        }
                    }

                    $data[] = $obj;
                }
            }
        }

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $resources = $this->orderRepo->report_daily($request);
        $height = 180;
        $reports = [];
        foreach ($resources as $resource) {
            if ($resource->id) {
                $height = (int)$height + 30;
                $id = $resource->id;
                if (count($reports) > 0) {
                    $rsTemp = array_filter(
                        $reports,
                        function ($row1) use ($id) {
                            return  $row1['id']  == $id;
                        }
                    );
                    if (count($rsTemp) == 0) {
                        $obj = [
                            'id' => $resource->id,
                            'name' => $resource->name,
                        ];

                        for ($d = 1; $d <= 20; $d++) {
                            $rsTemp = array_filter(
                                $resources,
                                function ($row1) use ($id, $d) {
                                    return  $row1->id  == $id && $row1->day  == $d;
                                }
                            );

                            if (count($rsTemp) > 0) {
                                foreach ($rsTemp as $row) {
                                    $obj["total_paid_$d"] = $row->total_paid;
                                    $obj["total_debt_$d"] = $row->total_debt;
                                }
                            } else {
                                $obj["total_paid_$d"] = 0;
                                $obj["total_debt_$d"] = 0;
                            }
                        }

                        $reports[] = $obj;
                    }
                } else {
                    $obj = [
                        'id' => $resource->id,
                        'name' => $resource->name,
                    ];

                    for ($d = 1; $d <= 20; $d++) {
                        $rsTemp = array_filter(
                            $resources,
                            function ($row1) use ($id, $d) {
                                return  $row1->id  == $id && $row1->day  == $d;
                            }
                        );

                        if (count($rsTemp) > 0) {
                            foreach ($rsTemp as $row) {
                                $obj["total_paid_$d"] = $row->total_paid;
                                $obj["total_debt_$d"] = $row->total_debt;
                            }
                        } else {
                            $obj["total_paid_$d"] = 0;
                            $obj["total_debt_$d"] = 0;
                        }
                    }

                    $reports[] = $obj;
                }
            }
        }

        $customPaper = array(0, 0, $height, 1850);
        switch ($request->doc_type) {
            case 'pdf':
                $doc = Pdf::loadView('pages.report.daily.export', ['reports' => $reports])
                    ->setPaper($customPaper, 'landscape');

                return $doc->download("Laporan Harian.pdf");
                break;
            case 'excel':
                return Excel::download(new ReportDailyExport($reports), 'Laporan Harian.xlsx');
                break;
        }
    }
}
