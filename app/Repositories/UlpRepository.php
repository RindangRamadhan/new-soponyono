<?php

namespace App\Repositories;

use App\Http\Requests\UlpRequest;
use App\Interfaces\UlpInterface;
use App\Models\Up3;
use App\Models\Ulp;
use Illuminate\Support\Facades\Auth;

class UlpRepository implements UlpInterface
{
    function list()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $ulp = Ulp::select('ulps.id','ulps.id AS ulps__id', 'ulps.name', 'ulps.name AS ulps__name',  'up3.name AS up3__name', 'ulps.latitude AS ulps__latitude', 'ulps.longitude AS ulps__longitude')->join('up3s AS up3', 'ulps.up3_id', 'up3.id')->join('uids as uid', 'uid.id', '=', 'up3.uid_id');

        switch ($tipe) {
            case 'ALL':
                $data = $ulp;
                break;
            case 'UP3':
                $data = $ulp->where('ulps.up3_id', $rowuser->up3_id);
                break;
            case 'ULP':
                $data = $ulp->where('ulps.ulp_id', $rowuser->ulp_id);
                break;
            default:
                $data = $ulp->where('up3.uid_id', $rowuser->uid_id);
                break;
        }

        return $data;
    }

    public function create()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $data = Up3::select('id', 'name as text');
        switch ($tipe) {
            case 'ALL':
                $up3s = $data->get();
                break;
            case 'UP3':
                $up3s = $data->where('id', $rowuser->up3_id)->get();
                break;
            case 'ULP':
                $up3s = $data->where('id', 00)->get();
                break;
            default:
                $up3s = $data->where('uid_id', $rowuser->uid_id)->get();
                break;
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

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $data = Up3::select('id', 'name as text');
        switch ($tipe) {
            case 'ALL':
                $up3s = $data->get();
                break;
            case 'UP3':
                $up3s = $data->where('id', $rowuser->up3_id)->get();
                break;
            case 'ULP':
                $up3s = $data->where('id', 00)->get();
                break;
            default:
                $up3s = $data->where('uid_id', $rowuser->uid_id)->get();
                break;
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
