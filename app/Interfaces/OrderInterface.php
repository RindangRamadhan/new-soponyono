<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface
{
    function list();
    function list_harian($up3_id,$ulp_id);
    function show($id);
    function show_petugas($id);
    function upload(Request $request);
    function destroy($id);
}
