<?php

namespace App\Exports;

use App\Models\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class OrderExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    protected $up3_id;
    protected $ulp_id;
    protected $start_date;
    protected $end_date;
    public function __construct($up3_id, $ulp_id, $start_date, $end_date)
    {
        $this->up3_id = $up3_id;
        $this->ulp_id = $ulp_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function headings(): array
    {
        return [
            [
                'UP3',
                'ULP',
                'ID PEL',
                'Nama',
                'Tarif',
                'Daya',
                'Kogol',
                'RBM',
                'Gardu',
                'Alamat',
                'RPTAG',
                'Nama Petugas',
                'Status',
                'Tanggal Upload',
                'Tanggal Janji',
                'No. HP',
                'Latitude',
                'Longitude',
            ],
        ];
    }

    public function map($row): array
    {
        return [
            $row->up3_name,
            $row->ulp_name,
            $row->customer_id,
            $row->customer_name,
            $row->tarif,
            $row->power,
            $row->class,
            $row->rbm_code,
            $row->substation,
            $row->address,
            $row->bill,
            $row->petugas_name,
            $row->billing_status,
            $row->updated_at,
            $row->updated_at,
            $row->phone_number,
            $row->latitude,
            $row->longitude,
        ];
    }

    public function query()
    {

        $end_date = $this->end_date . ' 23:59:59';
        $start_date = $this->start_date . ' 00:00:01';

        $order = Order::select(
            'orders.*',
            'customer.name as customer_name',
            'u.name as petugas_name',
            'u.rbm_code as rbm_code',
            'ulp.name AS ulp_name',
            'up3.name AS up3_name',
            DB::raw('(CASE WHEN orders.billing_status =  "Paid"  THEN "LUNAS"
            WHEN orders.billing_status =  "Debt"  THEN "JANJI" 
            ELSE "TIDAK DIEKSEKUSI" END) AS billing_status'),
            DB::raw('DATE_FORMAT(orders.updated_at,"%d/%m/%Y %h:%i:%s") as updated__in')
        )
            ->join('up3s AS up3', 'orders.up3_id', 'up3.id')
            ->join('ulps AS ulp', 'orders.ulp_id', 'ulp.id')
            ->join('customers AS customer', 'orders.customer_id', 'customer.id')
            ->join('users AS u', 'orders.user_id', 'u.id');

        if ($this->up3_id && $this->ulp_id == '-') {
            $data = $order
                ->where('orders.up3_id', $this->up3_id)
                ->whereBetween('orders.updated_at', [$start_date, $end_date]);
        } else {
            $data = $order
                ->where('orders.ulp_id', $this->ulp_id)
                ->whereBetween('orders.updated_at', [$this->start_date, $this->end_date]);
        }

        $data = $order->where('orders.status', 'Done');
        return $data;
    }
}
