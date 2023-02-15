<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\Up3Request;
use App\Interfaces\Up3Interface;
use App\Models\Uid;
use App\Models\Up3;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Up3Repository implements Up3Interface
{
    function list()
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;

        $data = [];
        if ($tipe == 'ALL') {
            $data = Up3::select('up3s.id', 'up3s.name', 'uid.name AS uid__name', 'up3s.latitude', 'up3s.longitude')->join('uids AS uid', 'up3s.uid_id', 'uid.id');
        } else if ($tipe == 'UP3') {
            $id_up3 = $rowuser->up3_id;
            $data = Up3::select('up3s.id', 'up3s.name', 'uid.name AS uid__name', 'up3s.latitude', 'up3s.longitude')->join('uids AS uid', 'up3s.uid_id', 'uid.id')->where([
                ['up3s.id', $id_up3]
            ]);
        } else if ($tipe == 'ULP') {
            $id_up3 = 00;
            $data = Up3::select('up3s.id', 'up3s.name', 'uid.name AS uid__name', 'up3s.latitude', 'up3s.longitude')->join('uids AS uid', 'up3s.uid_id', 'uid.id')->where([
                ['up3s.id', $id_up3]
            ]);
        } else {
            $id_uid = $rowuser->uid_id;
            $data = Up3::select('up3s.id', 'up3s.name', 'uid.name AS uid__name', 'up3s.latitude', 'up3s.longitude')->join('uids AS uid', 'up3s.uid_id', 'uid.id')
            ->where([
                ['up3s.uid_id', $id_uid]
            ]);
        }
        return $data;
    }

    public function create()
    {

        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
        $id_uid = $rowuser->uid_id;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $id_uid]
            ])->get();
        }

        return [$uids];
    }

    public function store(Up3Request $request)
    {

        Up3::create([
            'id' => $request->id,
            'uid_id' => $request->uid_id,
            'name' => $request->name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }

    public function edit($id)
    {
        $rsdata = Up3::select('up3s.*', 'uid.name AS uid_name')->join('uids AS uid', 'up3s.uid_id', 'uid.id')
            ->where('up3s.id', $id)
            ->first();

        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
        $id_uid = $rowuser->uid_id;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $id_uid]
            ])->get();
        }
        return [$rsdata, $uids];
    }

    public function update(Up3Request $request, $id)
    {
        $row = Up3::find($id);

        $row->update([
            'name' => $request->name,
            'uid_id' => $request->uid_id,
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
