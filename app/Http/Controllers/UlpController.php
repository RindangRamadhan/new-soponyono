<?php

namespace App\Http\Controllers;

use App\Models\Ulp;
use Illuminate\Http\Request;

class UlpController extends Controller
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
        $data = Ulp::select('id', 'name AS text')
            ->where('up3_id', $request->up3_id)
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
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function show(Ulp $ulp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function edit(Ulp $ulp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ulp $ulp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ulp  $ulp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ulp $ulp)
    {
        //
    }
}
