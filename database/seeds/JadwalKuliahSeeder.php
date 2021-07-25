<?php

use Illuminate\Database\Seeder;

class JadwalKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Jadwal Kuliah
        App\Schedule::create([
            'jurusan_id'      => 1,
            'makul_id'        => 3,
            'kategori_jadwal' => 'REG',
            'ruang'           => 'R. 201',
            'kelas_id'        => 2,
            'hari'            => 'Sabtu',
            'jam_mulai'       => '08:00',
            'jam_selesai'     => '09:00',
            'dosen_id'        => 1,
            'created_user'    => 'muharik',
            'updated_at'      => null,
        ]);

        // Sample Jadwal Kuliah
        App\Schedule::create([
            'jurusan_id'      => 1,
            'makul_id'        => 1,
            'kategori_jadwal' => 'REG',
            'ruang'           => 'R. 201',
            'kelas_id'        => 2,
            'hari'            => 'Selasa',
            'jam_mulai'       => '10:00',
            'jam_selesai'     => '11:00',
            'dosen_id'        => 1,
            'created_user'    => 'muharik',
            'updated_at'      => null,
        ]);

        // Sample Jadwal Kuliah
        App\Schedule::create([
            'jurusan_id'      => 1,
            'makul_id'        => 2,
            'kategori_jadwal' => 'REG',
            'ruang'           => 'R. 301',
            'kelas_id'        => 2,
            'hari'            => 'Senin',
            'jam_mulai'       => '10:00',
            'jam_selesai'     => '11:00',
            'dosen_id'        => 1,
            'created_user'    => 'muharik',
            'updated_at'      => null,
        ]);

        // Sample Jadwal Kuliah
        App\Schedule::create([
            'jurusan_id'      => 1,
            'makul_id'        => 1,
            'kategori_jadwal' => 'REG',
            'ruang'           => 'R. 106',
            'kelas_id'        => 2,
            'hari'            => 'Selasa',
            'jam_mulai'       => '10:00',
            'jam_selesai'     => '11:00',
            'dosen_id'        => 1,
            'created_user'    => 'muharik',
            'updated_at'      => null,
        ]);

        // Sample Jadwal Kuliah
        App\Schedule::create([
            'jurusan_id'      => 5,
            'makul_id'        => 3,
            'kategori_jadwal' => 'REG',
            'ruang'           => 'R. 106',
            'kelas_id'        => 2,
            'hari'            => 'Rabu',
            'jam_mulai'       => '10:00',
            'jam_selesai'     => '11:00',
            'dosen_id'        => 4,
            'created_user'    => 'muharik',
            'updated_at'      => null,
        ]);
    }
}
