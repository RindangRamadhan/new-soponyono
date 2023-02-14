<?php

namespace App\Interfaces;

use App\Http\Requests\Up3Request;

interface Up3Interface
{
    function list();
    function create();
    function store(Up3Request $request);
    function edit($id);
    function update(Up3Request $request, $id);
    function destroy($id);
}
