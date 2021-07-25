<?php

use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Kelas
        App\Classe::create([
            'jurusan_id'   => 1,
            'nama_kelas'   => 'TI 1/1',
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Kelas
        App\Classe::create([
            'jurusan_id'   => 1,
            'nama_kelas'   => 'TI 1/2',
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Kelas
        App\Classe::create([
            'jurusan_id'   => 1,
            'nama_kelas'   => 'TI 1/3',
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Kelas
        App\Classe::create([
            'jurusan_id'   => 1,
            'nama_kelas'   => 'TI 1/4',
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Kelas
        App\Classe::create([
            'jurusan_id'   => 1,
            'nama_kelas'   => 'TI 1/5',
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
