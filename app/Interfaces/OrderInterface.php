<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface
{
    function list();
    function list_harian($request);
    function list_detail($request);
    function list_monthly($request);
    function report_daily($request);
    function show($id);
    function show_petugas($id, $request);
    function upload(Request $request);
    function destroy($id);
}
