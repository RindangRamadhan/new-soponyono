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
                "name" => "Master Data",
                "guard_name" => "web",
            ],
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
        ];

        Permission::insert($permissions);

        $role = Role::create([
            'name' => 'Super Admin',
        ]);

        $role->givePermissionTo(Permission::all());
    }
}
