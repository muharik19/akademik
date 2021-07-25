<?php

use Illuminate\Database\Seeder;

class StudyProgramsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Program Studi
        App\StudyProgram::create([
            'kode_prodi'   => 'S1',
            'nama_prodi'   => 'Strata 1',
            'ka_prodi'     => 3,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);

        // Sample Program Studi
        App\StudyProgram::create([
            'kode_prodi'   => 'D3',
            'nama_prodi'   => 'Diploma 3',
            'ka_prodi'     => 4,
            'aktif'        => 'Y',
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
