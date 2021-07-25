<?php

use Illuminate\Database\Seeder;

class LastEducationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Pendidikan Terakhir
        App\LastEducation::create([
            'pendidikan_terakhir' => 'SD',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'SMP',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'SMA/SMK',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'D1 - D2',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'Diploma 3',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'Strata 1',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'Strata 2',
        ]);

        App\LastEducation::create([
            'pendidikan_terakhir' => 'Strata 3',
        ]);
    }
}
