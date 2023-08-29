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
    $type = Auth::user()->type;
    $up3_id = Auth::user()->up3_id;
    $ulp_id = Auth::user()->ulp_id;
    $uid_id = Auth::user()->uid_id;
    $last_month = $request->last_month;
    $first_month = $request->first_month;
    $args = [$first_month, $last_month];

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
            WHERE o.updated_at BETWEEN ? AND ?
        ";

    if ($type == 'ULP') {
      if ($request->ulp_id) {
        $query .= "
                    AND o.ulp_id = ?
                  ";

        $args[] = $request->ulp_id;
      } else {
        $query .= "
                    AND o.ulp_id = ?
                  ";
        $args[] = $ulp_id;
      }
    } else if ($type == 'UP3') {
      if ($request->ulp_id) {
        $query .= "
                    AND o.ulp_id = ?
                  ";

        $args[] = $request->ulp_id;
      }
      if ($request->up3_id) {
        $query .= "
                    AND o.up3_id = ?
                  ";

        $args[] = $request->up3_id;
      } else {
        $query .= "
                    AND o.up3_id = ?
                  ";

        $args[] = $up3_id;
      }
    } else if ($type == 'UID' || $type == 'UP2D' || $type == 'UP2K' || $type == 'ALL') {

      if ($request->ulp_id) {
        $query .= "
                    AND o.ulp_id = ?
                  ";

        $args[] = $request->ulp_id;
      }
      if ($request->up3_id) {
        $query .= "
                    AND o.up3_id = ?
                  ";

        $args[] = $request->up3_id;
      }

      $query .= "
              AND o.uid_id = ?
            ";
      $args[] = $uid_id;
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
                CASE WHEN o.status = 'On Progress' OR o.status = 'Open' THEN 1 ELSE NULL END
              ) AS total_wo,
              COUNT(
                CASE WHEN o.billing_status = 'Unpaid' AND  o.status = 'Done' THEN 1 ELSE NULL END
              ) AS total_not_executed
            FROM orders o
            WHERE  o.updated_at BETWEEN ? AND ?
        ";


    if ($type == 'ULP') {
      if ($request->ulp_id) {
        $querySO .= "
                    AND o.ulp_id = ?
                  ";
      }
    } else if ($type == 'UP3') {
      if ($request->ulp_id) {
        $querySO .= "
                    AND o.ulp_id = ?
                  ";
      }
      if ($request->up3_id) {
        $querySO .= "
                    AND o.up3_id = ?
                  ";
      }
    } else if ($type == 'UID' || $type == 'UP2D' || $type == 'UP2K' || $type == 'ALL') {

      if ($request->ulp_id) {
        $querySO .= "
                    AND o.ulp_id = ?
                  ";
      }
      if ($request->up3_id) {
        $querySO .= "
                    AND o.up3_id = ?
                  ";
      }
      $querySO .= "
              AND o.uid_id = ?
            ";
    }


    $status_orders = DB::select("$querySO", $args);

    $total_wo = Order::select('id')
      ->whereYear('created_at', $request->year)
      ->whereMonth('created_at', $request->month);

    $total_paid = Order::select('id')->where('status', 'Done')->where('billing_status', 'Paid')
      ->whereYear('created_at', $request->year)
      ->whereMonth('created_at', $request->month);
    // ->whereBetween(DB::raw("updated_at"), [$first_month, $last_month]);

    $total_promise = Order::select('id')->where('status', 'Done')->where('billing_status', 'Debt')
      ->whereYear('created_at', $request->year)
      ->whereMonth('created_at', $request->month);
    // ->whereBetween(DB::raw("updated_at"), [$first_month_1, $last_month]);

    $total_not_executed = Order::select('id')->where('status', 'Done')->where('billing_status', 'Unpaid')
      ->whereYear('created_at', $request->year)
      ->whereMonth('created_at', $request->month);
    // ->whereBetween(DB::raw("updated_at"), [$first_month_1, $last_month]);

    

    if ($type == 'ULP') {
      if ($request->ulp_id) {
        $total_wo = $total_wo->where('ulp_id', $request->ulp_id);
        $total_paid = $total_paid->where('ulp_id', $request->ulp_id);
        $total_promise = $total_promise->where('ulp_id', $request->ulp_id);
        $total_not_executed = $total_not_executed->where('ulp_id', $request->ulp_id);
      }else{
        $total_wo = $total_wo->where('ulp_id', $ulp_id);
        $total_paid = $total_paid->where('ulp_id', $ulp_id);
        $total_promise = $total_promise->where('ulp_id', $ulp_id);
        $total_not_executed = $total_not_executed->where('ulp_id', $ulp_id);
      }
    } else if ($type == 'UP3') {
      
      if ($request->up3_id) {
        $total_wo = $total_wo->where('up3_id', $request->up3_id);
        $total_paid = $total_paid->where('up3_id', $request->up3_id);
        $total_promise = $total_promise->where('up3_id', $request->up3_id);
        $total_not_executed = $total_not_executed->where('up3_id', $request->up3_id);
      }else{
        $total_wo = $total_wo->where('up3_id', $up3_id);
        $total_paid = $total_paid->where('up3_id', $up3_id);
        $total_promise = $total_promise->where('up3_id', $up3_id);
        $total_not_executed = $total_not_executed->where('up3_id', $up3_id);
      }
  
      if ($request->ulp_id) {
        $total_wo = $total_wo->where('ulp_id', $request->ulp_id);
        $total_paid = $total_paid->where('ulp_id', $request->ulp_id);
        $total_promise = $total_promise->where('ulp_id', $request->ulp_id);
        $total_not_executed = $total_not_executed->where('ulp_id', $request->ulp_id);
      }

    } else if ($type == 'UID' || $type == 'UP2D' || $type == 'UP2K' || $type == 'ALL') {

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
  
      if (!$request->up3_id && !$request->ulp_id) {
  
        $total_wo = $total_wo->where('uid_id', $uid_id);
        $total_paid = $total_paid->where('uid_id', $uid_id);
        $total_promise = $total_promise->where('uid_id', $uid_id);
        $total_not_executed = $total_not_executed->where('uid_id', $uid_id);
      }
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
