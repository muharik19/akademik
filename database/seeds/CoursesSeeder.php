<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Mata Kuliah
        App\Course::create([
            'prodi_id'     => 1,
            'dosen_id'     => 1,
            'kode_makul'   => '0001',
            'nama_makul'   => 'Riset Operasi',
            'semester'     => '1',
            'sks'          => 2,
            'jurusan_id'   => 1,
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Mata Kuliah
        App\Course::create([
            'prodi_id'     => 1,
            'dosen_id'     => 4,
            'kode_makul'   => '0002',
            'nama_makul'   => 'Metode Penelitian',
            'semester'     => '1',
            'sks'          => 2,
            'jurusan_id'   => 2,
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
        
        // Sample Mata Kuliah
        App\Course::create([
            'prodi_id'     => 1,
            'dosen_id'     => 1,
            'kode_makul'   => '0003',
            'nama_makul'   => 'Data Warehouse dan OLAP',
            'semester'     => '1',
            'sks'          => 2,
            'jurusan_id'   => 1,
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

    }
}
