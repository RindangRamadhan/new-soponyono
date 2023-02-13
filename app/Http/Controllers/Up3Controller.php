<?php

namespace App\Http\Controllers;

use App\Models\Up3;
use Illuminate\Http\Request;

class Up3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource for select2.
     *
     * @return \Illuminate\Http\Response
     */
    public function listSelect(Request $request)
    {
        $data = Up3::select('id', 'name AS text')
            ->where('uid_id', $request->uid_id)
            ->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Up3  $up3
     * @return \Illuminate\Http\Response
     */
    public function show(Up3 $up3)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Up3  $up3
     * @return \Illuminate\Http\Response
     */
    public function edit(Up3 $up3)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Up3  $up3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Up3 $up3)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Up3  $up3
     * @return \Illuminate\Http\Response
     */
    public function destroy(Up3 $up3)
    {
        //
    }
}
