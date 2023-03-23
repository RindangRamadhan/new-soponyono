<?php

namespace App\Http\Controllers;

use App\Interfaces\OrderInterface;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

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
    function list(Request $request)
    {

        $resources = $this->detailRepo->list_monthly($request);
        return response()->json($resources);
    }

    public function share_all($up3_id, $ulp_id, $month, $year)
    {

        $args = [$month, $year];

        $query = "
          WITH vtb_top_officer AS (
            SELECT
              u.name,
              COUNT( o.id
              ) AS total_wo,
              COUNT(
                CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
              ) AS total_paid,
              COUNT(
                CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
              ) AS total_debt,
              COUNT(
                CASE WHEN o.billing_status = 'Debt' OR  o.billing_status = 'Paid' THEN 1 ELSE NULL END
              ) AS total_realisasi,
              0 as total_persen
            FROM orders o
              JOIN users u
                ON o.user_id = u.id
            WHERE MONTH(o.updated_at) = ? AND YEAR(o.updated_at) = ?
        ";

        if ($up3_id) {
            $query .= "
                    AND o.up3_id = ?
                  ";

            $args[] = $up3_id;
        }

        if ($ulp_id != '-') {
            $query .= "
                    AND o.ulp_id = ?
                  ";

            $args[] = $ulp_id;
        }
        $query .= "
                  GROUP BY u.id
                )
              ";

        $top_officers = DB::select("
          $query
          SELECT
            *
          FROM vtb_top_officer
          ORDER BY total_realisasi DESC
        ", $args);

        if ($top_officers) {
            $no=1;
            foreach ($top_officers as &$v) {
                $v->no=$no++;
                $total_persen = (int)$v->total_realisasi / (int)$v->total_wo * 100;
                $v->total_persen = number_format($total_persen,2)  ;
            }

            $pdf = PDF::loadview('pages.report.monthlys.share_all', ['top_officers' => $top_officers])->setWarnings(false);
            return $pdf->download('share-monthly-all.pdf');
            return $top_officers;
        } else {
            return 'Data Kosong';
        }
    }
}
