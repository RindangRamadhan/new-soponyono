<?php

namespace App\Http\Controllers;

class MonitoringLocationController extends Controller
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
            'isReload' => true,
            'isCreate' => true,
            'permission' => [
                'create' => 'Lokasi-Lokasi Tambah',
                'update' => 'Lokasi-Lokasi Edit',
                'delete' => 'Lokasi-Lokasi Hapus',
            ],
        ];

        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Lokasi"],
        ];

        return view('pages.locations.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }
}
