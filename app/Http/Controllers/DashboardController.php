<?php

namespace App\Http\Controllers;

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

        return view('dashboard')->with([
            'pageConfigs' => $pageConfigs,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
