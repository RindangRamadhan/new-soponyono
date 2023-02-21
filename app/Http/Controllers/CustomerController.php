<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerInterface;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepo;

    public function __construct(CustomerInterface $customerRepo)
    {
        $this->customerRepo = $customerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $pageConfigs = [
            'pageHeader' => true,
            'isReload' => true,
            'isCreate' => false,
            'permission' => [
                'create' => 'Pelanggan-Pelanggan Tambah',
                'detail' => 'Pelanggan-Pelanggan Lihat',
                'update' => 'Pelanggan-Pelanggan Edit',
                'delete' => 'Pelanggan-Pelanggan Hapus',
            ],
        ];
        $breadcrumbs = [
            ["link" => "/", "name" => "Home"],
            ["link" => "#", "name" => "Master Data"],
            ["link" => "#", "name" => "Pelanggan"],
        ];

        return view('pages.master-data.customers.index')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
            ])
        );
    }


    function list(Request $request)
    {

        $resources = $this->customerRepo->list();

        list($records, $recordsTotal, $recordsFiltered) = Helper::selectServerSide(
            $request,
            $resources,
            "/master-data/customers",
            "Pelanggan",
            ['detail'],
            ['delete','edit'],
        );

        $result = [
            "draw" => intval($request->draw),
            "recordsTotal" => intval($recordsTotal),
            "recordsFiltered" => intval($recordsFiltered),
            "data" => $records,
        ];

        return json_encode($result);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'isSave' => true,
            'permission' => [
                'create' => 'Pelanggan-Pelanggan Tambah',
                'detail' => 'Pelanggan-Pelanggan Lihat',
                'update' => 'Pelanggan-Pelanggan Edit',
                'delete' => 'Pelanggan-Pelanggan Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Master Data",
            ],
            [
                "link" => "master-data/customers",
                "name" => "Pelanggan",
            ],
            [
                "name" => "Tambah",
            ],
        ];
        list($uids,) = $this->customerRepo->create();
        return view('pages.master-data.customers.create')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'uids',
            ])
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $this->customerRepo->store($request);
        return redirect('/master-data/customers')->with(['status' => 200]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'permission' => [
                'create' => 'Pelanggan-Pelanggan Tambah',
                'detail' => 'Pelanggan-Pelanggan Lihat',
                'update' => 'Pelanggan-Pelanggan Edit',
                'delete' => 'Pelanggan-Pelanggan Hapus',
            ],
        ];


        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Master Data",
            ],
            [
                "link" => "master-data/customers",
                "name" => "Pelanggan",
            ],
            [
                "name" => "Detail",
            ],
        ];

        list($customer) = $this->customerRepo->show($id);

        return view('pages.master-data.customers.detail')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'customer',
            ])
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageConfigs = [
            'pageHeader' => true,
            'isBack' => true,
            'isSave' => true,
            'permission' => [
                'create' => 'Pelanggan-Pelanggan Tambah',
                'detail' => 'Pelanggan-Pelanggan Lihat',
                'update' => 'Pelanggan-Pelanggan Edit',
                'delete' => 'Pelanggan-Pelanggan Hapus',
            ],
        ];

        $breadcrumbs = [
            [
                "link" => "/",
                "name" => "Home",
            ],
            [
                "link" => "#",
                "name" => "Master Data",
            ],
            [
                "link" => "master-data/customers",
                "name" => "Pelanggan",
            ],
            [
                "name" => "Edit",
            ],
        ];

        list($customer, $uids) = $this->customerRepo->edit($id);

        return view('pages.master-data.customers.edit')->with(
            compact([
                'pageConfigs',
                'breadcrumbs',
                'customer',
                'uids',
            ])
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $this->customerRepo->update($request, $id);
        return redirect('/master-data/customers')->with(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
        return response()->json(['status' => 200]);
    }
}
