<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;

interface UserInterface
{
    function list();
    function create();
    function store(UserRequest $request);
    function show($id);
    function edit($id);
    function update(UserRequest $request, $id);
    function upload(Request $request);
}
