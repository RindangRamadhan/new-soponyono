<?php

namespace App\Repositories;

use App\Imports\OrderImport;
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
    function list() {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;

        $order = Order::select('orders.id', 'orders.id As orders__id', 'orders.status AS orders__status', 'orders.bill AS orders__bill', 'customer.name as customer__name', 'user.name as user__name', 'up3.name AS up3__name', 'ulp.name AS ulp__name')
            ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
            ->join('uids as uid', 'uid.id', '=', 'up3.uid_id')
            ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
            ->join('customers AS customer', 'orders.customer_id', 'customer.id')
            ->join('users AS user', 'orders.user_id', 'user.id')
            ->where('orders.created_by', $rowuser->id);

        if ($tipe == 'UP3') {
            $data = $order->where([
                ['orders.up3_id', $rowuser->up3_id],
            ]);
        } else if ($tipe == 'ULP') {
            $data = $order
                ->where([
                    ['orders.ulp_id', $rowuser->ulp_id],
                ]);
        } else if ($tipe == 'ALL') {
            $data = $order;
        } else {

            $data = $order->where([
                ['orders.uid_id', $rowuser->uid_id],
            ]);
        }

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

            if ($request->up3_id && ! $request->ulp_id) {
                $order = $order
                    ->where('orders.up3_id', $request->up3_id)
                    ->whereBetween('orders.created_at', [$request->start_date, $end_date]);
            }else if ($request->ulp_id) {
                $order = $order
                    ->where('orders.ulp_id', $request->ulp_id)
                    ->whereBetween('orders.created_at', [$request->start_date, $end_date]);
            }else{
                $order = $order->where('orders.ulp_id', 00);
            }

        $data = $order->groupBy('orders.user_id');

        return $data;
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
            'user.rbm_code AS rbm_code'
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
            'orders.billing_status',
            'orders.latitude',
            'orders.longitude',
        )
            ->join('customers AS customer', 'orders.customer_id', 'customer.id')
            ->where('orders.user_id', $id)
            ->where('orders.billing_status', 'Paid');

        if ($request->up3_id) {
            $orders = $orders
                ->where('orders.up3_id', $request->up3_id);
        }

        if ($request->ulp_id) {
            $orders = $orders
                ->where('orders.ulp_id', $request->ulp_id);
        }

        if ($request->start_date && $request->end_date) {
            $orders = $orders
                ->whereBetween('orders.updated_at', [$request->start_date, $end_date]);
        }

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
                    'customer_id' => $v[2],
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
                    $upload_succeed++;
                    $id_up3 = $v[0];
                    $id_ulp = $v[1];
                    $customer_id = $v[2];
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

                    $ulp = Ulp::select('id')->where('id', $id_ulp);
                    if ($ulp->count() == 0) {
                        $upload_failed['reason'] = "ULP tidak ditemukan";
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

                    $rowuser = User::select('id')->where('rbm_code', $rbm_code)->first();
                    if ($rowuser->count() == 0) {
                        $upload_failed['reason'] = "Kode RBM tidak ditemukan";
                        $upload_faileds[] = $upload_failed;
                        continue;
                    } else {
                        $user_id = $rowuser->id;
                    }

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
                        'created_by' => $created_by,
                        'uuid' => $uuid,
                    ]);
                }
            }

            if (count($upload_faileds) > 0) {
                OrderUploadFailed::query()->delete();
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
        } catch (\Throwable$th) {
            DB::rollBack();
            throw $th;
        }

        return response()->json([
            'status' => 200,
            'order_upload' => $upload_succeed,
            'order_failed' => count($upload_faileds),
        ]);
    }

    public function destroy($id)
    {
        $role = Order::find($id);
        $role->delete();
    }
}
