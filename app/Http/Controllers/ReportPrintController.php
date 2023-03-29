<?php

namespace App\Http\Controllers;


use App\Helpers\Helper;
use App\Interfaces\OrderInterface;
use App\Models\Up3;
use App\Models\Order;
use App\Models\ManagerUlp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

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
    function list(Request $request)
    {
        $resources = $this->detailRepo->list_print($request);

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/report/print",
            "Cetak",
            ['detail', 'print'],
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

        $ulp_id = $order->ulp_id;

        $manager_ulp = ManagerUlp::select(
            'manager_ulps.*',
            'user.name AS manager_name'
        )
            ->join('users AS user', 'manager_ulps.user_id', 'user.id')
            ->where('manager_ulps.ulp_id', $ulp_id)
            ->first();
        

        $order->bill = "Rp. " . number_format($order->bill, 0, ',', '.');

        Order::where('id', $id)
            ->update([
                'printout_status' => 'Sudah',
            ]);

        $date_now = Helper::FormatDateIndo(date('Y-m-d'), 'l, j F Y');
        $pdf = PDF::loadview('pages.report.prints.cetak', ['order' => $order, 'manager_ulp' => $manager_ulp, 'date_now' => $date_now])->setPaper('a4', 'portrait')->setWarnings(false);
        return $pdf->download('cetak-pratul.pdf');

        // return view('pages.report.prints.cetak')->with(
        //     compact([
        //         'order',
        //         'manager_ulp',
        //         'date_now',
        //     ])
        // );
    }

    public function print_all($user_id, $month, $year)
    {
        
        $orders = Order::select(
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
            ->where('orders.user_id', $user_id)
            ->where('orders.billing_status', 'Paid')
            ->whereMonth('orders.updated_at', $month)
            ->whereYear('orders.updated_at', $year)->get();

        if ($orders) {

            $ulp_id = $orders[0]->ulp_id;

            $manager_ulp = ManagerUlp::select(
                'manager_ulps.*',
                'user.name AS manager_name'
            )
                ->join('users AS user', 'manager_ulps.user_id', 'user.id')
                ->where('manager_ulps.ulp_id', $ulp_id)
                ->first();


            foreach ($orders as &$v) {
                $v["bill"] = "Rp. " . number_format($v["bill"], 2, ',', '.');
            }

            Order::where('orders.user_id', $user_id)
                ->where('orders.billing_status', 'Paid')
                ->whereMonth('orders.updated_at', $month)
                ->whereYear('orders.updated_at', $year)
                ->update([
                    'printout_status' => 'Sudah',
                ]);

            $date_now = Helper::FormatDateIndo(date('Y-m-d'), 'l, j F Y');
            $pdf = PDF::loadview('pages.report.prints.cetak_all', ['orders' => $orders, 'manager_ulp' => $manager_ulp, 'date_now' => $date_now])->setPaper('a4', 'portrait')->setWarnings(false);
            return $pdf->download('cetak-pratul-all.pdf');
        } else {
            return 'Data Kosong';
        }
    }
}
