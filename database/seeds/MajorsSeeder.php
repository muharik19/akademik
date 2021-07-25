<?php

use Illuminate\Database\Seeder;

class MajorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Jurusan
        App\Major::create([
            'kode_jurusan' => 'TI',
            'prodi_id'     => 1,
            'nama_jurusan' => 'Teknik Informatika',
            'dosen_id'     => 1,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Jurusan
        App\Major::create([
            'kode_jurusan' => 'SI',
            'prodi_id'     => 2,
            'nama_jurusan' => 'Sistem Informasi',
            'dosen_id'     => 2,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Jurusan
        App\Major::create([
            'kode_jurusan' => 'MI',
            'prodi_id'     => 3,
            'nama_jurusan' => 'Manajemen Informatika',
            'dosen_id'     => 3,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Jurusan
        App\Major::create([
            'kode_jurusan' => 'KA',
            'prodi_id'     => 4,
            'nama_jurusan' => 'Komputerisasi Akuntansi',
            'dosen_id'     => 4,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
