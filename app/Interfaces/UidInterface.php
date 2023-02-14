<?php

namespace App\Interfaces;

use App\Http\Requests\UidRequest;

interface UidInterface
{
    function list();
    function create();
    function store(UidRequest $request);
    function edit($id);
    function update(UidRequest $request, $id);
    function destroy($id);
}
