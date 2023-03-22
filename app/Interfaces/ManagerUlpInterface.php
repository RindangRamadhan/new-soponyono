<?php

namespace App\Interfaces;

use App\Http\Requests\ManagerUlpRequest;

interface ManagerUlpInterface
{
    function list();
    function create();
    function store(ManagerUlpRequest $request);
    function edit($id);
    function update(ManagerUlpRequest $request, $id);
    function destroy($id);
}
