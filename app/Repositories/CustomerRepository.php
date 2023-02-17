<?php

namespace App\Repositories;

use App\Helpers\Helper;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerInterface;
use App\Models\Uid;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerRepository implements CustomerInterface
{
    function list()
    {
        $rowuser = User::find(Auth::user()->id);
        $tipe = $rowuser->type;
        $data = [];
        if ($tipe == 'ALL') {
            $data = Customer::select('customers.id', 'customers.id_pel', 'customers.name',  'up3.name AS up3__name', 'ulp.name AS ulp__name', 'customers.phone_number',  'customers.gardu',  'customers.status')
                ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
                ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id');
        } else if ($tipe == 'UP3') {
            $id_up3 = $rowuser->up3_id;
            $data = Customer::select('customers.id', 'customers.id_pel', 'customers.name',  'up3.name AS up3__name', 'ulp.name AS ulp__name', 'customers.phone_number',  'customers.gardu',  'customers.status')
                ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
                ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id')
                ->where('customers.up3_id', $id_up3);
        } else if ($tipe == 'ULP') {
            $id_ulp = $rowuser->ulp_id;
            $data = Customer::select('customers.id', 'customers.id_pel', 'customers.name',  'up3.name AS up3__name', 'ulp.name AS ulp__name', 'customers.phone_number',  'customers.gardu',  'customers.status')
                ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
                ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id')
                ->where('customers.ulp_id', $id_ulp);
        } else {
            $id_uid = $rowuser->uid_id;
            $data = Customer::select('customers.id', 'customers.id_pel', 'customers.name',  'up3.name AS up3__name', 'ulp.name AS ulp__name', 'customers.phone_number',  'customers.gardu',  'customers.status')
                ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id')
                ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
                ->join('uids as uid', 'uid.id', '=', 'up3.uid_id')
                ->where('up3.uid_id', $id_uid);
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
        $statuss = Helper::CustomerStatus();
        return [$uids, $statuss];
    }

    public function store(CustomerRequest $request)
    {

        Customer::create([
            'id' => $request->id,
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'id_pel' => $request->id_pel,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'tarif' => $request->tarif,
            'daya' => $request->daya,
            'kogol' => $request->kogol,
            'gardu' => $request->gardu,
            'address' => $request->address,
            'status' => $request->status,
        ]);
    }

    public function detail($id)
    {
        $customer = Customer::select(
            'customers.*',
            'uid.name AS uid_name',
            'up3.name AS up3_name',
            'ulp.name AS ulp_name',
        )
            ->join('uids AS uid', 'customers.uid_id', 'uid.id')
            ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
            ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id')
            ->where('customers.id', $id)
            ->first();

        
        
        return [$customer];
    }

    public function edit($id)
    {
        $customer = Customer::select(
            'customers.*',
            'up3.name AS up3_name'
        )->join('up3s AS up3', 'customers.up3_id', 'up3.id')
        ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id')
            ->where('customers.id', $id)
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
        $statuss = Helper::CustomerStatus();
        return [$customer, $uids, $statuss];
    }

    public function update(CustomerRequest $request, $id)
    {
        $row = Customer::find($id);

        $row->update([
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'id_pel' => $request->id_pel,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'tarif' => $request->tarif,
            'daya' => $request->daya,
            'kogol' => $request->kogol,
            'gardu' => $request->gardu,
            'address' => $request->address,
            'status' => $request->status,
        ]);
    }

    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
    }
}
