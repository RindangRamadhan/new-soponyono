<?php

namespace App\Repositories;

use App\Http\Requests\UidRequest;
use App\Interfaces\UidInterface;
use App\Models\Uid;
use Illuminate\Support\Facades\Auth;

class UidRepository implements UidInterface
{
    function list()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        
        if ($tipe == 'ALL') {
            $data = Uid::select('id', 'name', 'phone_number', 'address', 'latitude', 'longitude');
        } else {
            $data = Uid::select('id', 'name', 'phone_number', 'address', 'latitude', 'longitude')->where([
                ['id', $rowuser->uid_id]
            ]);
        }
        return $data;
    }

    public function create()
    {

        return;
    }

    public function store(UidRequest $request)
    {

        Uid::create([
            'id' => $request->id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }

    public function edit($id)
    {
        $uid = Uid::select('uids.*')
            ->where('uids.id', $id)
            ->first();


        return [$uid];
    }

    public function update(UidRequest $request, $id)
    {
        $uid = Uid::find($id);

        $uid->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
    }

    public function destroy($id)
    {
        $role = Uid::find($id);
        $role->delete();
    }
}
