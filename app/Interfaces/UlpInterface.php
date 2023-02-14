<?php

namespace App\Interfaces;

use App\Http\Requests\UlpRequest;

interface UlpInterface
{
    function list();
    function create();
    function store(UlpRequest $request);
    function edit($id);
    function update(UlpRequest $request, $id);
    function destroy($id);
}
