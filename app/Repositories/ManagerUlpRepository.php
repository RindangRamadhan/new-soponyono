<?php

namespace App\Repositories;

use App\Http\Requests\ManagerUlpRequest;
use App\Interfaces\ManagerUlpInterface;
use App\Models\Ulp;
use App\Models\ManagerUlp;
use Illuminate\Support\Facades\Auth;

class ManagerUlpRepository implements ManagerUlpInterface
{
    function list()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $ulp = ManagerUlp::select('manager_ulps.id', 'manager_ulps.location as name__location', 'ulp.name AS ulp__name', 'user.name', 'user.name as user__name')
            ->join('users AS user', 'manager_ulps.user_id', 'user.id')
            ->join('ulps AS ulp', 'manager_ulps.ulp_id', 'ulp.id')
            ->join('up3s as up3', 'up3.id', '=', 'ulp.up3_id')
            ->join('uids as uid', 'uid.id', '=', 'up3.uid_id');

        switch ($tipe) {
            case 'ALL':
                $data = $ulp;
                break;
            case 'UP3':
                $data = $ulp->where('ulp.up3_id', $rowuser->up3_id);
                break;
            case 'ULP':
                $data = $ulp->where('manager_ulps.ulp_id', $rowuser->ulp_id);
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
        $data = Ulp::select('ulps.id', 'ulps.name as text')
            ->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
            ->join('uids as uid', 'uid.id', '=', 'up3.uid_id');
        switch ($tipe) {
            case 'ALL':
                $ulps = $data->get();
                break;
            case 'UP3':
                $ulps = $data->where('ulps.up3_id', $rowuser->up3_id)->get();
                break;
            case 'ULP':
                $ulps = $data->where('ulps.id', $rowuser->ulp_id)->get();
                break;
            default:
                $ulps = $data->where('up3.uid_id', $rowuser->uid_id)->get();
                break;
        }

        return [$ulps];
    }

    public function store(ManagerUlpRequest $request)
    {

        ManagerUlp::create([
            'ulp_id' => $request->ulp_id,
            'user_id' => $request->user_id,
            'location' => $request->location,
        ]);
    }

    public function edit($id)
    {
        $manager_ulp = ManagerUlp::select(
            'manager_ulps.*',
            'ulp.name AS ulp_name',
            'user.name AS user_name'
        )->join('ulps AS ulp', 'manager_ulps.ulp_id', 'ulp.id')
            ->join('users AS user', 'manager_ulps.user_id', 'user.id')
            ->where('manager_ulps.id', $id)
            ->first();

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $data = Ulp::select('ulps.id', 'ulps.name as text')
            ->join('up3s AS up3', 'ulps.up3_id', 'up3.id')
            ->join('uids as uid', 'uid.id', '=', 'up3.uid_id');
        switch ($tipe) {
            case 'ALL':
                $ulps = $data->get();
                break;
            case 'UP3':
                $ulps = $data->where('ulps.up3_id', $rowuser->up3_id)->get();
                break;
            case 'ULP':
                $ulps = $data->where('ulps.id', $rowuser->ulp_id)->get();
                break;
            default:
                $ulps = $data->where('up3.uid_id', $rowuser->uid_id)->get();
                break;
        }
        return [$manager_ulp, $ulps];
    }

    public function update(ManagerUlpRequest $request, $id)
    {
        $row = ManagerUlp::find($id);

        $row->update([
            'ulp_id' => $request->ulp_id,
            'user_id' => $request->user_id,
            'location' => $request->location,
        ]);
    }

    public function destroy($id)
    {
        $role = ManagerUlp::find($id);
        $role->delete();
    }
}
