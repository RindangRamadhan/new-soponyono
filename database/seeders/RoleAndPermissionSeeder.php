<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                "name" => "Master Data-Pengguna",
                "guard_name" => "web",
            ],
            [
                "name" => "Pengguna-Pengguna Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Pengguna-Pengguna Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Pengguna-Pengguna Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Pengguna-Pengguna Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data-Pelanggan",
                "guard_name" => "web",
            ],
            [
                "name" => "Pelanggan-Pelanggan Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Pelanggan-Pelanggan Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Pelanggan-Pelanggan Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Pelanggan-Pelanggan Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data-Hak Akses",
                "guard_name" => "web",
            ],
            [
                "name" => "Hak Akses-Hak Akses Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Hak Akses-Hak Akses Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Hak Akses-Hak Akses Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Hak Akses-Hak Akses Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Monitoring",
                "guard_name" => "web",
            ],
            [
                "name" => "Monitoring-Lokasi",
                "guard_name" => "web",
            ],
            [
                "name" => "Lokasi-Lokasi Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Lokasi-Lokasi Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Lokasi-Lokasi Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Lokasi-Lokasi Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Monitoring-Order",
                "guard_name" => "web",
            ],
            [
                "name" => "Order-Order Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Order-Order Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Order-Order Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Order-Order Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data-Uid",
                "guard_name" => "web",
            ],
            [
                "name" => "Uid-Uid Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Uid-Uid Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Uid-Uid Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Uid-Uid Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data-Up3",
                "guard_name" => "web",
            ],
            [
                "name" => "Up3-Up3 Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Up3-Up3 Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Up3-Up3 Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Up3-Up3 Hapus",
                "guard_name" => "web",
            ],
            [
                "name" => "Master Data-Ulp",
                "guard_name" => "web",
            ],
            [
                "name" => "Ulp-Ulp Tambah",
                "guard_name" => "web",
            ],
            [
                "name" => "Ulp-Ulp Lihat",
                "guard_name" => "web",
            ],
            [
                "name" => "Ulp-Ulp Edit",
                "guard_name" => "web",
            ],
            [
                "name" => "Ulp-Ulp Hapus",
                "guard_name" => "web",
            ],

        ];

        Permission::insert($permissions);

        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $role->givePermissionTo(Permission::all());
    }
}
