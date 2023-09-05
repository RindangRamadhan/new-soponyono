<?php

namespace App\Repositories;

use App\Imports\OrderImport;
use App\Imports\OrderDeleteImport;
use App\Interfaces\OrderInterface;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderUploadFailed;
use App\Models\OrderUploadLog;
use App\Models\Ulp;
use App\Models\Up3;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class OrderRepository implements OrderInterface
{
  function list()
  {
    $user_id = Auth::user()->id;
    // $tipe = $rowuser->type;

    $data = Order::select('orders.id', 'orders.id As orders__id', 'orders.status AS orders__status', 'orders.bill AS orders__bill', 'customer.name as customer__name', 'user.name as user__name', 'up3.name AS up3__name', 'ulp.name AS ulp__name')
      ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
      ->join('uids as uid', 'uid.id', '=', 'up3.uid_id')
      ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
      ->join('customers AS customer', 'orders.customer_id', 'customer.id')
      ->join('users AS user', 'orders.user_id', 'user.id')
      ->where('orders.created_by', $user_id)
      ->whereMonth('orders.created_at', date('m'));

    // if ($tipe == 'UP3') {
    //   $data = $order->where([
    //     ['orders.up3_id', $rowuser->up3_id],
    //   ]);
    // } else if ($tipe == 'ULP') {
    //   $data = $order
    //     ->where([
    //       ['orders.ulp_id', $rowuser->ulp_id],
    //     ]);
    // } else if ($tipe == 'ALL') {
    //   $data = $order;
    // } else {

    //   $data = $order->where([
    //     ['orders.uid_id', $rowuser->uid_id],
    //   ]);
    // }

    return $data;
  }

  public function list_harian($request)
  {
    $date = Carbon::createFromFormat('Y-m-d', $request->end_date)->startOfDay();
    $end_date = Carbon::parse($date->addDays(1))->toDateString();

    $order = Order::select(
      'orders.id',
      'orders.id AS orders__id',
      'orders.user_id',
      'orders.status',
      'orders.bill',
      'u.name as u__name',
      'up3.name AS up3__name',
      'ulp.name AS ulp__name'
    )
      ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
      ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
      ->join('users AS u', 'orders.user_id', 'u.id');

    if ($request->up3_id) {
      $order = $order
        ->where('orders.up3_id', $request->up3_id);
    }

    if ($request->ulp_id) {
      $order = $order
        ->where('orders.ulp_id', $request->ulp_id);
    }

    if ($request->start_date && $request->end_date) {
      $order = $order
        ->whereBetween('orders.updated_at', [$request->start_date, $end_date]);
    }

    $order = $order->groupBy('orders.user_id');

    return $order;
  }

  public function list_detail($request)
  {
    $date = Carbon::createFromFormat('Y-m-d', $request->end_date)->startOfDay();
    $end_date = Carbon::parse($date->addDays(1))->toDateString();

    $order = Order::select(
      'orders.id',
      'orders.id AS orders__id',
      'orders.user_id',
      'orders.bill',
      'customer.name as customer__name',
      'u.name as u__name',
      'ulp.name AS ulp__name',
      DB::raw('(CASE WHEN orders.billing_status =  "Paid"  THEN "LUNAS"
            WHEN orders.billing_status =  "Debt"  THEN "JANJI"
            ELSE "TIDAK DIEKSEKUSI" END) AS billing_status'),
      DB::raw('DATE_FORMAT(orders.updated_at,"%d/%m/%Y %h:%i:%s") as updated__in')
    )
      ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
      ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
      ->join('customers AS customer', 'orders.customer_id', 'customer.id')
      ->join('users AS u', 'orders.user_id', 'u.id');

    if ($request->up3_id) {
      $order = $order
        ->where('orders.up3_id', $request->up3_id);
    }

    if ($request->ulp_id) {
      $order = $order
        ->where('orders.ulp_id', $request->ulp_id);
    }

    if ($request->start_date && $request->end_date) {
      $order = $order
        ->whereBetween('orders.updated_at', [$request->start_date, $end_date]);
    }

    $order = $order->where('orders.status', 'Done');

    return $order;
  }

  public function list_monthly($request)
  {
    $uid_id = Auth::user()->uid_id;
    $month = $request->month;
    $year = $request->year;
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
              ) AS total_realisasi
            FROM orders o
              JOIN users u
                ON o.user_id = u.id
            WHERE MONTH(o.updated_at) = ? AND YEAR(o.updated_at) = ?
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
                    AND o.uid_id = ?
                  ";
    $args[] = $uid_id;
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

    return $top_officers;
  }

  public function list_print($request)
  {

    $month = $request->month;
    $year = $request->year;
    $ulp_id = $request->ulp_id;
    $args = [$month, $year, $ulp_id];

    $query = "
        WITH vtb_top_officer AS (
          SELECT
            u.id as id,
            u.name as u__name,
            COUNT( o.id
            ) AS total__wo,

            CASE WHEN o.printout_status = 'Belum'  THEN o.printout_status ELSE o.printout_status END as printout_status
            
          FROM orders o
            JOIN users u
              ON o.user_id = u.id
          WHERE MONTH(o.created_at) = ? AND YEAR(o.created_at) = ? AND o.ulp_id = ?
      ";
    $query .= "
          GROUP BY u.id
        )
      ";

    $top_officers = DB::select("
          $query
          SELECT
          *
          FROM vtb_top_officer
          ORDER BY u__name asc
          ", $args);

    return $top_officers;
  }

  public function report_daily($request)
  {
    if ($request->up3_id) {
      $args = [$request->up3_id, $request->month, $request->year];
      $query = DB::select("
            WITH RECURSIVE days AS (
              SELECT 1 AS n
                UNION ALL
              SELECT n + 1 FROM days WHERE n < 20
            )
            SELECT
              u.id,
              u.name,
              COUNT(
                CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
              ) AS total_paid,
              COUNT(
                CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
              ) AS total_debt,
              d.n AS 'day'
            FROM days d
              LEFT JOIN orders o
                ON DAY(o.updated_at) = d.n
              LEFT JOIN users u
                ON o.user_id = u.id
            WHERE o.up3_id = ?
              AND MONTH(o.updated_at) = ?
              AND YEAR(o.updated_at) = ?
            GROUP BY 1,5
            ORDER BY 2 ASC
          ", $args);
    } else if ($request->ulp_id) {
      $args = [$request->up3_id, $request->ulp_id, $request->month, $request->year];
      $query = DB::select("
          WITH RECURSIVE days AS (
            SELECT 1 AS n
              UNION ALL
            SELECT n + 1 FROM days WHERE n < 20
          )
          SELECT
            u.id,
            u.name,
            COUNT(
              CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
            ) AS total_paid,
            COUNT(
              CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
            ) AS total_debt,
            d.n AS 'day'
          FROM days d
            LEFT JOIN orders o
              ON DAY(o.updated_at) = d.n
            LEFT JOIN users u
              ON o.user_id = u.id
          WHERE  o.ulp_id = ?
            AND MONTH(o.updated_at) = ?
            AND YEAR(o.updated_at) = ?
          GROUP BY 1,5
          ORDER BY 2 ASC
        ", $args);
    } else {
      $uid_id = Auth::user()->uid_id;
      $args = [$uid_id, $request->month, $request->year];
      $query = DB::select("
          WITH RECURSIVE days AS (
            SELECT 1 AS n
              UNION ALL
            SELECT n + 1 FROM days WHERE n < 20
          )
          SELECT
            u.id,
            u.name,
            COUNT(
              CASE WHEN o.billing_status = 'Paid' THEN 1 ELSE NULL END
            ) AS total_paid,
            COUNT(
              CASE WHEN o.billing_status = 'Debt' THEN 1 ELSE NULL END
            ) AS total_debt,
            d.n AS 'day'
          FROM days d
            LEFT JOIN orders o
              ON DAY(o.updated_at) = d.n
            LEFT JOIN users u
              ON o.user_id = u.id
          WHERE o.uid_id = ?
            AND MONTH(o.updated_at) = ?
            AND YEAR(o.updated_at) = ?
          GROUP BY 1,5
          ORDER BY 2 ASC
        ", $args);
    }

    return $query;
  }

  public function show($id)
  {
    $order = Order::select(
      'orders.*',
      'uid.name AS uid_name',
      'up3.name AS up3_name',
      'ulp.name AS ulp_name',
      'customer.name AS customer_name',
      'customer.address AS customer_address',
      'user.name AS officer_name',
      'user.rbm_code AS rbm_code',
      DB::raw('(CASE WHEN orders.billing_status =  "Paid"  THEN "LUNAS"
            WHEN orders.billing_status =  "Debt"  THEN "JANJI" ELSE "TIDAK DIEKSEKUSI" END) AS billing_status')
    )
      ->join('uids AS uid', 'orders.uid_id', 'uid.id')
      ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
      ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
      ->join('customers AS customer', 'orders.customer_id', 'customer.id')
      ->join('users AS user', 'orders.user_id', 'user.id')
      ->where('orders.id', $id)
      ->first();

    return [$order];
  }

  public function show_petugas($id, $request)
  {
    $date = Carbon::createFromFormat('Y-m-d', $request->end_date)->startOfDay();
    $end_date = Carbon::parse($date->addDays(1))->toDateString();

    $user = User::select('name AS officer_name', 'rbm_code')
      ->where('id', $id)
      ->first();

    $orders = Order::select(
      'orders.customer_id',
      'customer.name AS customer_name',
      'orders.tarif',
      'orders.power',
      'orders.substation',
      'orders.bill',
      'orders.status',
      DB::raw('(CASE WHEN orders.billing_status =  "Paid"  THEN "LUNAS"
            WHEN orders.billing_status =  "Debt"  THEN "JANJI"
            ELSE "TIDAK DIEKSEKUSI" END) AS billing_status'),
      'orders.latitude',
      'orders.longitude',
    )
      ->join('customers AS customer', 'orders.customer_id', 'customer.id')
      ->where('orders.user_id', $id);
    // ->where('orders.billing_status', 'Paid');

    // if ($request->up3_id) {
    //   $orders = $orders
    //     ->where('orders.up3_id', $request->up3_id);
    // }

    // if ($request->ulp_id) {
    //   $orders = $orders
    //     ->where('orders.ulp_id', $request->ulp_id);
    // }

    if ($request->start_date && $request->end_date) {
      $orders = $orders
        ->whereBetween('orders.updated_at', [$request->start_date, $end_date]);
    }

    $orders = $orders->get();

    return [$user, $orders];
  }

  public function show_petugas_cetak($id, $month, $year)
  {

    $user = User::select('name AS officer_name', 'rbm_code')
      ->where('id', $id)
      ->first();

    $orders = Order::select(
      'orders.id',
      'orders.customer_id',
      'customer.name AS customer_name',
      'orders.tarif',
      'orders.power',
      'orders.printout_status',
      'orders.bill',
    )
      ->join('customers AS customer', 'orders.customer_id', 'customer.id')
      ->where('orders.user_id', $id)
      ->whereMonth('orders.created_at', $month)
      ->whereYear('orders.created_at', $year);


    $orders = $orders->get();

    return [$user, $orders];
  }

  public function upload(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:csv,xls,xlsx',
    ]);
    $rowuser = Auth::user();
    $id_uid = $rowuser->uid_id;
    $created_by = $rowuser->id;
    $created_at = new \DateTime();
    $uuid = Str::uuid()->toString();
    // Get file excel from requests
    $file = $request->file('file');

    // Convert Excel to Array
    $excels = Excel::toArray(new OrderImport, $file);

    DB::beginTransaction();

    try {
      $upload_succeed = 0;
      $upload_faileds = [];

      foreach ($excels[0] as $k => $v) {
        // Skip Header
        if ($k == 0) {
          continue;
        }

        $upload_failed = [
          'uid_id' => $id_uid,
          'up3_id' => $v[0],
          'ulp_id' => $v[1],
          'customer_id' => (string)$v[2],
          'name' => $v[3],
          'tarif' => $v[4],
          'power' => $v[5],
          'class' => $v[6],
          'rbm_code' => $v[7],
          'substation' => $v[8],
          'address' => $v[9],
          'bill' => $v[10],
          'created_by' => $created_by,
          'created_at' => new \DateTime(),
        ];

        if ($v[0]) {

          $id_up3 = $v[0];
          $id_ulp = $v[1];
          $customer_id = (string)$v[2];
          $name = $v[3];
          $tarif = $v[4];
          $power = $v[5];
          $class = $v[6];
          $rbm_code = $v[7];
          $substation = $v[8];
          $address = $v[9];
          $bill = $v[10];

          $up3 = Up3::select('id')->where('id', $id_up3);
          if ($up3->count() == 0) {
            $upload_failed['reason'] = "UP3 tidak ditemukan";
            $upload_faileds[] = $upload_failed;
            continue;
          }

          $ulp = Ulp::select('id')->where('id', $id_ulp)->where('up3_id', $id_up3);
          if ($ulp->count() == 0) {
            $upload_failed['reason'] = "ULP tidak ditemukan / relasi Ke UP3 tidak benar";
            $upload_faileds[] = $upload_failed;
            continue;
          }

          $customer = Customer::select('id')->where('id', $customer_id);
          if ($customer->count() == 0) {
            Customer::create([
              'id' => $customer_id,
              'uid_id' => $id_uid,
              'up3_id' => $id_up3,
              'ulp_id' => $id_ulp,
              'name' => $name,
              'phone_number' => '',
              'tarif' => $tarif,
              'power' => $power,
              'class' => $class,
              'substation' => $substation,
              'address' => $address,
            ]);
          } else {
            $row = Customer::find($customer_id);
            $row->update([
              'uid_id' => $id_uid,
              'up3_id' => $id_up3,
              'ulp_id' => $id_ulp,
              'tarif' => $tarif,
              'power' => $power,
              'class' => $class,
              'substation' => $substation,
            ]);
          }
          if ($rbm_code) {
            $rowuser = User::select('id')->where('rbm_code', $rbm_code)->where('ulp_id', $id_ulp)->first();
            if (!$rowuser) {
              $upload_failed['reason'] = "Kode RBM tidak ditemukan";
              $upload_faileds[] = $upload_failed;
              continue;
            } else {
              $user_id = $rowuser->id;
            }
          } else {
            $upload_failed['reason'] = "Kode RBM tidak ditemukan";
            $upload_faileds[] = $upload_failed;
            continue;
          }


          $upload_succeed++;
          Order::create([
            'customer_id' => $customer_id,
            'user_id' => $user_id,
            'uid_id' => $id_uid,
            'up3_id' => $id_up3,
            'ulp_id' => $id_ulp,
            'tarif' => $tarif,
            'power' => $power,
            'class' => $class,
            'substation' => $substation,
            'bill' => $bill,
            'photos' => '',
            'status' => 'Open',
            'billing_status' => 'Unpaid',
            'printout_status' => 'Belum',
            'created_by' => $created_by,
            'uuid' => $uuid,
          ]);
        }
      }

      if (count($upload_faileds) > 0) {
        OrderUploadFailed::where('created_by', $created_by)->delete();
        OrderUploadFailed::insert($upload_faileds);
      }
      if ($upload_succeed != 0) {
        OrderUploadLog::create([
          'uuid' => $uuid,
          'created_by' => $created_by,
          'created_at' => new \DateTime(),
        ]);
      }

      DB::commit();
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }

    return response()->json([
      'status' => 200,
      'order_upload' => $upload_succeed,
      'order_failed' => count($upload_faileds),
    ]);
  }

  public function delete_upload(Request $request)
  {
    $request->validate([
      'file' => 'required|mimes:csv,xls,xlsx',
    ]);

    // Get file excel from requests
    $file = $request->file('file');

    // Convert Excel to Array
    $excels = Excel::toArray(new OrderDeleteImport, $file);

    DB::beginTransaction();

    try {
      $upload_succeed = 0;
      $upload_faileds = 0;

      foreach ($excels[0] as $k => $v) {
        // Skip Header
        if ($k == 0) {
          continue;
        }
        $id_pel = (string)$v[0];


        if ($id_pel) {

          $total = Order::select('id')->where('customer_id', $id_pel)
            ->whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'));
          if ($total->count() == 0) {
            $upload_faileds++;
          } else {
            
            DB::table('orders')
              ->where('customer_id', $id_pel)
              ->whereYear('created_at', date('Y'))
              ->whereMonth('created_at', date('m'))
              ->delete();

            $upload_succeed++;
          }
        }
      }


      DB::commit();
    } catch (\Throwable $th) {
      DB::rollBack();
      throw $th;
    }

    return response()->json([
      'status' => 200,
      'order_upload' => $upload_succeed,
      'order_failed' => $upload_faileds,
    ]);
  }

  public function destroy($id)
  {
    $role = Order::find($id);
    $role->delete();
  }
}
