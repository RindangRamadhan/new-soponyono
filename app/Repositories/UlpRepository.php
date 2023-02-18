<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\UlpRequest;
use App\Interfaces\UlpInterface;
use App\Models\Up3;
use App\Models\Ulp;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UlpRepository implements UlpInterface
{
    function list()
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
       
        if ($tipe == 'ALL') {
            $data = Ulp::select('ulps.id', 'ulps.name',  'up3.name AS up3__name', 'ulps.latitude', 'ulps.longitude')->join('up3s AS up3', 'ulps.up3_id', 'up3.id');
        } else if ($tipe == 'UP3') {
            $id_up3 = $rowuser->up3_id;
            $data = Ulp::select('ulps.id', 'ulps.name',  'up3.name AS up3__name', 'ulps.latitude', 'ulps.longitude')
                ->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
                ->where('ulps.up3_id', $id_up3);
        } else if ($tipe == 'ULP') {
            $id_ulp = $rowuser->ulp_id;
            $data = Ulp::select('ulps.id', 'ulps.name',  'up3.name AS up3__name', 'ulps.latitude', 'ulps.longitude')->join('up3s AS up3', 'ulps.up3_id', 'up3.id')->where('ulps.id', $id_ulp);
        } else {
            $id_uid = $rowuser->uid_id;
            $data = Ulp::select('ulps.id', 'ulps.name',  'up3.name AS up3__name', 'ulps.latitude', 'ulps.longitude')
                ->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
                ->join('uids as uid', 'uid.id', '=', 'up3.uid_id')
                ->where('up3.uid_id', $id_uid);
        }
        return $data;
    }

    public function create()
    {
        $rowuser = User::find(Auth::user()->id);
        $up3s = [];
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $up3s = Up3::select('id', 'name as text')->get();
        } else if ($tipe == 'UP3') {
            $id_up3 = $rowuser->up3_id;
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $id_up3)
                ->get();
        } else if ($tipe == 'ULP') {
            $id_up3 = 00;
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $id_up3)
                ->get();
        } else {
            $id_uid = $rowuser->uid_id;
            $up3s = Up3::select('id', 'name AS text')
                ->where('uid_id', $id_uid)
                ->get();
        }

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
        $ulp = Ulp::select(
            'ulps.*',
            'up3.name AS up3_name'
        )->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
            ->where('ulps.id', $id)
            ->first();

        $rowuser = User::find(Auth::user()->id);
        $up3s = [];
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $up3s = Up3::select('id', 'name as text')->get();
        } else if ($tipe == 'UP3') {
            $id_up3 = $rowuser->up3_id;
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $id_up3)
                ->get();
        } else if ($tipe == 'ULP') {
            $id_up3 = 00;
            $up3s = Up3::select('id', 'name AS text')
                ->where('id', $id_up3)
                ->get();
        } else {
            $id_uid = $rowuser->uid_id;
            $up3s = Up3::select('id', 'name AS text')
                ->where('uid_id', $id_uid)
                ->get();
        }
        return [$ulp, $up3s];
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
