<?php

namespace App\Http\Controllers;

use App\Exports\OrderUploadFailedExport;
use App\Helpers\Helper;
use App\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\OrderUploadLog;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderRepo;

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
                'create' => 'Order-Order Tambah',
                'update' => 'Order-Order Edit',
                'delete' => 'Order-Order Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Order"],
        ];
        $id = Auth::user()->id;
        $logs = OrderUploadLog::select('uuid','created_at', )
        ->where('created_by', $id)
        ->get();
        return view('pages.orders.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'logs',
            ])
        );
    }

    function list(Request $request)
    {
        $resources = $this->orderRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/monitoring/orders",
            "Order",
            ['detail'],
            ['delete','edit'],
        );

        $result = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $records,
        ];

        return json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function show($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'permission' => [
                'create' => 'Order-Order Tambah',
                'detail' => 'Order-Order Lihat',
                'update' => 'Order-Order Edit',
                'delete' => 'Order-Order Hapus',
            ],
        ];


        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            
            [
                "link" => "monitoring/orders",
                "name" => "Order",
            ],
            [
                "name" => "Detail",
            ],
        ];

        list($order) = $this->orderRepo->show($id);

        return view('pages.orders.detail')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'order',
            ])
        );
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Order::find($id)->delete();
        return response()->json(['status' => 200]);
    }

    public function download()
    {
        return response()->download(public_path('excel/Template Order.xlsx'));
    }

    public function upload(Request $request)
    {
        return $this->orderRepo->upload($request);
    }

    public function export()
    {
        $filename = "Daftar order gagal upload.xlsx";
        return Excel::download(new OrderUploadFailedExport(), $filename);
    }

}
