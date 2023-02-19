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
        $rowuser = Auth::user();
        $tipe = $rowuser->type;

        $up3 = Up3::select('up3s.id', 'up3s.name', 'uid.name AS uid__name', 'up3s.latitude', 'up3s.longitude')->join('uids AS uid', 'up3s.uid_id', 'uid.id');

        switch ($tipe) {
            case 'ALL':
                $data = $up3;
                break;
            case 'UP3':
                $data = $up3->where('up3s.id', $rowuser->up3_id);
                break;
            case 'ULP':
                $data = $up3->where('up3s.id', 00);
                break;
            default:
                $data = $up3->where('up3s.uid_id', $rowuser->uid_id);
                break;
        }

        return $data;
    }

    public function create()
    {

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $rowuser->uid_id]
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
        $up3 = Up3::select('up3s.*', 'uid.name AS uid_name')->join('uids AS uid', 'up3s.uid_id', 'uid.id')
            ->where('up3s.id', $id)
            ->first();

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $rowuser->uid_id]
            ])->get();
        }
        return [$up3, $uids];
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
