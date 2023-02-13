<?php

namespace App\Interfaces;

use App\Http\Requests\RoleRequest;

interface RoleInterface
{
    function list();
    function create();
    function store(RoleRequest $request);
    function edit($id);
    function update(RoleRequest $request, $id);
    function destroy($id);
}
