<?php

use Illuminate\Database\Seeder;

class ScoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Score
        App\Score::create([
            'nim'          => '2011140023',
            'makul_id'     => 1,
            'uts'          => 80,
            'uas'          => 90,
            'nilai'        => 4,
            'sks'          => 2,
            'mutu'         => 8,
            'created_user' => 'muharik',
            'updated_at'   => null,
        ]);
    }
}
