<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\UlpRequest;
use App\Interfaces\UlpInterface;
use App\Models\Up3;
use App\Models\Ulp;

class UlpRepository implements UlpInterface
{
    function list()
    {
        return Ulp::select('ulps.id', 'ulps.name',  'up3.name AS up3__name','ulps.latitude', 'ulps.longitude')->join('up3s AS up3', 'ulps.up3_id', 'up3.id');
    }

    public function create()
    {
        $up3s = Up3::select('id', 'name as text')->get();

        return [$up3s];
    }

    public function store(UlpRequest $request)
    {

        Ulp::create([
            'id' => $request->id,
            'up3_id' => $request->up3_id,
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }

    public function edit($id)
    {
        $rsdata = Ulp::select('ulps.*',
        'up3.name AS up3_name')->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
            ->where('ulps.id', $id)
            ->first();

        $up3s = Up3::select('id', 'name as text')->get();
        return [$rsdata, $up3s];
    }

    public function update(UlpRequest $request, $id)
    {
        $row = Ulp::find($id);

        $row->update([
            'name' => $request->name,
            'up3_id' => $request->up3_id,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }

    public function destroy($id)
    {
        $role = Up3::find($id);
        $role->delete();
    }
}
