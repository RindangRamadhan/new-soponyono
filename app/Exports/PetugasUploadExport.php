<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class PetugasUploadExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;
    protected $status;
    public function __construct($status)
    {
        $this->status = $status;
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
                'Jabatan',
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
            $row->uid__name,
            $row->up3__name,
            $row->ulp__name,
            $row->r__name,
            $row->position,
        ];
    }

    public function query()
    {
        $rowuser = Auth::user();
        $tipe = $rowuser->type;
        $user = User::select(
            'users.*',
            'uid.name AS uid__name',
            'up3.name AS up3__name',
            'ulp.name AS ulp__name',
            'r.name AS r__name',
        )
            ->join('uids AS uid', 'users.uid_id', 'uid.id')
            ->join('up3s AS up3', 'users.up3_id', 'up3.id')
            ->join('ulps AS ulp', 'users.ulp_id', 'ulp.id')
            ->join('model_has_roles AS mhr', 'users.id', 'mhr.model_id')
            ->join('roles AS r', 'mhr.role_id', 'r.id')
            ->where('users.status', $this->status);
        if ($tipe == 'UP3') {
            $data = $user->where([
                ['users.up3_id', $rowuser->up3_id],
            ])->where(function ($query) {
                $query->where('type', 'UP3')
                    ->orWhere('type', 'ULP');
            });
        } else if ($tipe == 'ULP') {
            $data = $user->where([
                ['users.ulp_id', $rowuser->ulp_id],
                ['type', '=', 'ULP'],
            ]);
        } else if ($tipe == 'ALL') {
            $data = $user;
        } else {
            $data = $user->where([
                ['users.uid_id', $rowuser->uid_id],
            ]);
        }
        return $data;
    }
}
