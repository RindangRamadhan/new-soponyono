<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'permission' => [
                'create' => 'Dashboard-Dashboard Tambah',
                'update' => 'Dashboard-Dashboard Edit',
                'delete' => 'Dashboard-Dashboard Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["name" => "Dashboard"],
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

        return view('dashboard')->with([
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
            'up3s' => $up3s,
            'months' => $months,
            'years' => $years,
        ]);
    }

    public function filter(Request $request)
    {
        // $month = ($request->month < 10) ? "0$request->month" : $request->month;
        // $date = "$request->year-$month-" . date("d");
        $str_month = (($request->month - 3) < 0) ? 1 : ($request->month - 3);
        $end_month = $request->month - 1;

        $args = [$request->year, $str_month, $end_month];

        $query = "
          WITH vtb_top_officer AS (
            SELECT
              u.id,
              u.name,
              COUNT(
                CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
              ) AS total_paid,
              COUNT(
                CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
              ) AS total_debt
            FROM orders o
              JOIN users u
                ON o.user_id = u.id
            WHERE YEAR(o.updated_at) = ?
                AND MONTH(o.updated_at) BETWEEN ? AND ?
        ";

        if ($request->up3_id) {
            $query .= "
              AND o.up3_id = ?
            ";

            $args[] = $request->up3_id;
        }

        if ($request->ulp_id) {
            $query .= "
              AND o.ulp_id = ?
            ";

            $args[] = $request->ulp_id;
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
          ORDER BY (total_paid + total_debt) DESC
          LIMIT 10
        ", $args);

        $bottom_officers = DB::select("
          $query
          SELECT
            *
          FROM vtb_top_officer
          ORDER BY (total_paid + total_debt) ASC
          LIMIT 10
        ", $args);

        $querySO = "
          SELECT
              COUNT(
                CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
              ) AS total_paid,
              COUNT(
                CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
              ) AS total_debt,
              COUNT(
                CASE WHEN o.status = 'On Progress' THEN 1 ELSE NULL END
              ) AS total_not_executed
            FROM orders o
            WHERE YEAR(o.updated_at) = ?
                AND MONTH(o.updated_at) BETWEEN ? AND ?
        ";

        if ($request->up3_id) {
            $querySO .= "
              AND o.up3_id = ?
            ";
        }

        if ($request->ulp_id) {
            $querySO .= "
              AND o.ulp_id = ?
            ";
        }

        $status_orders = DB::select("$querySO", $args);

        $total_wo = Order::select('id')
            ->whereYear('updated_at', $request->year)
            ->whereBetween(DB::raw("MONTH(updated_at)"), [$str_month, $end_month]);

        $total_paid = Order::select('id')->where('billing_status', 'Paid')
            ->whereYear('updated_at', $request->year)
            ->whereBetween(DB::raw("MONTH(updated_at)"), [$str_month, $end_month]);

        $total_promise = Order::select('id')->where('billing_status', 'Debt')
            ->whereYear('updated_at', $request->year)
            ->whereBetween(DB::raw("MONTH(updated_at)"), [$str_month, $end_month]);

        $total_not_executed = Order::select('id')->where('status', 'On Progress')
            ->whereYear('updated_at', $request->year)
            ->whereBetween(DB::raw("MONTH(updated_at)"), [$str_month, $end_month]);

        if ($request->up3_id) {
            $total_wo = $total_wo->where('up3_id', $request->up3_id);
            $total_paid = $total_paid->where('up3_id', $request->up3_id);
            $total_promise = $total_promise->where('up3_id', $request->up3_id);
            $total_not_executed = $total_not_executed->where('up3_id', $request->up3_id);
        }

        if ($request->ulp_id) {
            $total_wo = $total_wo->where('ulp_id', $request->ulp_id);
            $total_paid = $total_paid->where('ulp_id', $request->ulp_id);
            $total_promise = $total_promise->where('ulp_id', $request->ulp_id);
            $total_not_executed = $total_not_executed->where('ulp_id', $request->ulp_id);
        }

        $total_wo = $total_wo->get();
        $total_paid = $total_paid->get();
        $total_promise = $total_promise->get();
        $total_not_executed = $total_not_executed->get();

        return response()->json([
            "top_officers" => $top_officers,
            "bottom_officers" => $bottom_officers,
            "status_orders" => $status_orders,
            "total_wo" => $total_wo->count(),
            "total_paid" => $total_paid->count(),
            "total_promise" => $total_promise->count(),
            "total_not_executed" => $total_not_executed->count(),
        ]);
    }
}
