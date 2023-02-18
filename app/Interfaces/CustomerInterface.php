<?php

namespace App\Interfaces;

use App\Http\Requests\CustomerRequest;

interface CustomerInterface
{
    function list($id_up3, $id_ulp);
    function create();
    function store(CustomerRequest $request);
    function detail($id);
    function edit($id);
    function update(CustomerRequest $request, $id);
    function destroy($id);
}
