<?php

namespace App\Repositories;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerInterface;
use App\Models\Uid;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerRepository implements CustomerInterface
{
    function list()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;

        $customer = Customer::select('customers.id','customers.id AS customers__id', 'customers.name','customers.name AS customers__name',  'up3.name AS up3__name', 'ulp.name AS ulp__name', 'customers.phone_number',  'customers.substation AS customers__substation')
            ->join('up3s AS up3', 'customers.up3_id', 'up3.id')
            ->join('uids as uid', 'uid.id', '=', 'up3.uid_id')
            ->join('ulps AS ulp', 'customers.ulp_id', 'ulp.id');

        switch ($tipe) {
            case 'ALL':
                $data = $customer;
                break;
            case 'UP3':
                $data = $customer->where('customers.up3_id', $rowuser->up3_id);
                break;
            case 'ULP':
                $data = $customer->where('customers.ulp_id', $rowuser->ulp_id);
                break;
            default:
                $data = $customer->where('up3.uid_id', $rowuser->uid_id);
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

    public function store(CustomerRequest $request)
    {

        Customer::create([
            'id' => $request->id,
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'tarif' => $request->tarif,
            'power' => $request->power,
            'class' => $request->class,
            'substation' => $request->substation,
            'address' => $request->address,
        ]);
    }

    public function show($id)
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

        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        if ($tipe == 'ALL') {
            $uids = Uid::select('id', 'name as text')->get();
        } else {
            $uids = Uid::select('id', 'name as text')->where([
                ['id', $rowuser->uid_id]
            ])->get();
        }
        return [$customer, $uids];
    }

    public function update(CustomerRequest $request, $id)
    {
        $row = Customer::find($id);

        $row->update([
            'uid_id' => $request->uid_id,
            'up3_id' => $request->up3_id,
            'ulp_id' => $request->ulp_id,
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'tarif' => $request->tarif,
            'power' => $request->power,
            'class' => $request->class,
            'substation' => $request->substation,
            'address' => $request->address,
        ]);
    }

    public function destroy($id)
    {
        $data = Customer::find($id);
        $data->delete();
    }
}
