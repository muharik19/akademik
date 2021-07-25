<?php

use Illuminate\Database\Seeder;

class LecturersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Dosen
        App\Lecturer::create([
            'kode_dosen'   => '10000001',
            'nama_dosen'   => 'Dr. Chandra Lukita, S.E., M.M.',
            'alamat'       => 'Taman Cipto',
            'agama'        => 'Kristen',
            'email'        => 'chandra.lukita@mimalabs.com',
            'jk'           => 'L',
            'telp'         => '02189751236',
            'hp'           => '085712345678',
            'pendidikanID' => 8,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Dosen
        App\Lecturer::create([
            'kode_dosen'    => '10000002',
            'nama_dosen'   => 'Dr. Yucki Prihadi, S.Si., M.M., M.Kom.',
            'alamat'       => 'Jakarta',
            'agama'        => 'Islam',
            'email'        => 'yucki.prihadi@mimalabs.com',
            'jk'           => 'L',
            'telp'         => '085714793548',
            'hp'           => '081212347896',
            'pendidikanID' => 8,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Dosen
        App\Lecturer::create([
            'kode_dosen'   => '10000003',
            'nama_dosen'   => 'Ridho Taufiq Subagio, S.T., M.Kom.',
            'alamat'       => 'Cirebon',
            'agama'        => 'Islam',
            'email'        => 'ridho.taufiq@mimalabs.com',
            'jk'           => 'L',
            'telp'         => '088873214068',
            'hp'           => '083812387453',
            'pendidikanID' => 7,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Dosen
        App\Lecturer::create([
            'kode_dosen'   => '10000004',
            'nama_dosen'   => 'Saluky, S.Si., M.Kom.',
            'alamat'       => 'Cirebon',
            'agama'        => 'Islam',
            'email'        => 'saluky@mimalabs.com',
            'jk'           => 'L',
            'telp'         => '089912654785',
            'hp'           => '081254789524',
            'pendidikanID' => 7,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        App\Lecturer::create([
            'kode_dosen'   => '10000005',
            'nama_dosen'   => 'Rinaldi Adam, M.Comp.',
            'alamat'       => 'Jakarta',
            'agama'        => 'Islam',
            'email'        => 'rinaldi.adam@mimalabs.com',
            'jk'           => 'L',
            'telp'         => '089924531087',
            'hp'           => '081358741203',
            'pendidikanID' => 7,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
