<?php

namespace App\Exports;

use App\Models\OrderUploadFailed;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class OrderUploadFailedExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct()
    {
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
                'Create At',
                'Keterangan Gagal',
            ],
        ];
    }

    public function map($row): array
    {
        return [
            $row->up3_id,
            $row->ulp_id,
            $row->customer_id,
            $row->name,
            $row->tarif,
            $row->power,
            $row->class,
            $row->rbm_code,
            $row->substation,
            $row->address,
            $row->bill,
            $row->created_at,
            $row->reason,
        ];
    }

    public function query()
    {
        $id = Auth::user()->id;

        return OrderUploadFailed::select(
            'order_upload_faileds.*'
        )->where('order_upload_faileds.created_by', $id);
    }
}
