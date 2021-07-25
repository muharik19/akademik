<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Administrator
        App\User::create([
            'nip' => '2020010101',
            'nama_lengkap' => 'Ahmad Muharik Al Ansori',
            'username'     => 'muharik',
            'agama'        => 'Islam',
            'email'        => 'muharik@mimalabs.com',
            'aktif'        => 'Y',
            'level'        => 1,
            'password'     => bcrypt('secret'),
            'pendidikanID' => 6,
            'created_user' => 'muharik',
            'updated_at' => null,
        ]);

        // Sample Staff Kampus
        App\User::create([
            'nip'          => '2020010102',
            'nama_lengkap' => 'Muhammad Setiyawan',
            'username'     => 'setiyawan',
            'agama'        => 'Islam',
            'email'        => 'setiyawan@mimalabs.com',
            'aktif'        => 'Y',
            'level'        => 2,
            'password'     => bcrypt('secret'),
            'pendidikanID' => 6,
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
