<?php

namespace App\Exports;

use App\Models\UserUploadFailed;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserUploadFailedExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function __construct()
    {
    }

    public function headings(): array
    {
        return [
            [
                'User Name',
                'Kode RBM',
                'Nama',
                'No. Hp',
                'Tipe',
                'Jabatan',
                'UID',
                'UP3',
                'ULP',
                'Kode Hak Akses',
                'Keterangan',
            ],
        ];
    }

    public function map($row): array
    {
        return [
            $row->user_name,
            $row->rbm_code,
            $row->name,
            $row->phone,
            $row->type,
            $row->position,
            $row->uid_id,
            $row->up3_id,
            $row->ulp_id,
            $row->role,
            $row->reason,
        ];
    }

    public function query()
    {
        return UserUploadFailed::query();
    }
}
