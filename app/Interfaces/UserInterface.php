<?php

namespace App\Interfaces;

use App\Http\Requests\UserRequest;
use App\Http\Requests\PetugasRequest;
use Illuminate\Http\Request;

interface UserInterface
{
    function list($status);
    function create();
    function store(UserRequest $request);
    function store_petugas(PetugasRequest $request);
    function show($id);
    function edit($id);
    function reset_password($id);
    function update(UserRequest $request, $id);
    function edit_petugas($id);
    function update_petugas(PetugasRequest $request, $id);
    function upload(Request $request);
    function upload_petugas(Request $request);
}
