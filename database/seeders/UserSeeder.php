<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uid_id' => 17,
            'up3_id' => 17171,
            'ulp_id' => 17100,
            'user_name' => 'sa',
            'rbm_code' => '000',
            'name' => 'Super Admin',
            'type' => 'Admin',
            'password' => Hash::make('Lampung2023'),
        ]);
    }
}
