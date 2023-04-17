<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Interfaces\OrderInterface;
use App\Models\Up3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitoringHarianController extends Controller
{

    protected $harianRepo;

    public function __construct(OrderInterface $harianRepo)
    {
        $this->harianRepo = $harianRepo;
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
            ["link" => "#", "name" => "Monitoring"],
        ];

        return view('pages.monitoring.harians.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'up3s',
            ])
        );
    }
    function list(Request $request) {
        $resources = $this->harianRepo->list_harian($request);

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/monitoring",
            "Harian",
            [],
            ['detail', 'delete', 'edit'],
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
                'create' => 'Harian-Harian Tambah',
                'detail' => 'Harian-Harian Lihat',
                'update' => 'Harian-Harian Edit',
                'delete' => 'Harian-Harian Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Monitoring",
            ],
            [
                "name" => "Detail",
            ],
        ];

        list($user, $orders) = $this->harianRepo->show_petugas($id, $request);

        foreach ($orders as &$v) {
            $v["bill"] = "Rp. " . number_format($v["bill"], 0, ',', '.');
        }
        
        return view('pages.monitoring.harians.detail')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'user',
                'orders',
            ])
        );
    }

    public function location($id, Request $request)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'permission' => [
                'create' => 'Harian-Harian Tambah',
                'detail' => 'Harian-Harian Lihat',
                'update' => 'Harian-Harian Edit',
                'delete' => 'Harian-Harian Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Monitoring",
            ],
            [
                "name" => "Lokasi",
            ],
        ];

        list($user, $orders) = $this->harianRepo->show_petugas($id, $request);

        return view('pages.monitoring.harians.map')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'user',
                'orders',
            ])
        );
    }
}
