<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface OrderInterface
{
    function list();
    function show($id);
    function upload(Request $request);
    function destroy($id);
}
