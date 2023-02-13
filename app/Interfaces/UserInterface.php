<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;

interface UserInterface
{
    function list();
    function create();
    function store(UserRequest $request);
    function edit($id);
    function update(UserRequest $request, $id);
}
