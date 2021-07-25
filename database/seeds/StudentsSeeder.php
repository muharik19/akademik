<?php

use Illuminate\Database\Seeder;

class StudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample Mahasiswa
        App\Student::create([
            'nim'            => '2011140023',
            'nama_mahasiswa' => 'Ahmad Muharik Al Ansori',
            'alamat'         => 'Pondok Serut 1',
            'jk'             => 'L',
            'telp'           => '082113158722',
            'hp'             => '087772488816',
            'agama'          => 'Islam',
            'email'          => 'ahmadmuharik@gmail.com',
            'tempat_lahir'   => 'Bogor',
            'tanggal_lahir'  => '1992-08-19',
            'prodi_id'       => 1,
            'jurusan_id'     => 1,
            'kelas_id'       => 2,
            'kategori_kelas' => 'REG',
            'aktif'          => 'Y',
            'created_user'   => 'muharik',
            'updated_at'     => null,
        ]);

        // Sample Mahasiswa
        App\Student::create([
            'nim'            => '2011140024',
            'nama_mahasiswa' => 'Desy Tri Rahayu',
            'alamat'         => 'Pondok Serut 1',
            'jk'             => 'P',
            'telp'           => '082154788988',
            'hp'             => '088814520365',
            'agama'          => 'Islam',
            'email'          => 'desy25@gmail.com',
            'tempat_lahir'   => 'Tangerang',
            'tanggal_lahir'  => '1992-12-25',
            'prodi_id'       => 1,
            'jurusan_id'     => 5,
            'kelas_id'       => 8,
            'kategori_kelas' => 'REG',
            'aktif'          => 'Y',
            'created_user'   => 'muharik',
            'updated_at'     => null,
        ]);

        // Sample Mahasiswa
        App\Student::create([
            'nim'            => '2011140025',
            'nama_mahasiswa' => 'Achmad Wahyudi',
            'alamat'         => 'Pondok Serut 1',
            'jk'             => 'L',
            'telp'           => '087772455889',
            'hp'             => '085902558886',
            'agama'          => 'Islam',
            'email'          => 'achmadyud@gmail.com',
            'tempat_lahir'   => 'Tangerang',
            'tanggal_lahir'  => '1982-01-05',
            'prodi_id'       => 1,
            'jurusan_id'     => 1,
            'kelas_id'       => 2,
            'kategori_kelas' => 'REG',
            'aktif'          => 'Y',
            'created_user'   => 'muharik',
            'updated_at'     => null,
        ]);

        // Sample Mahasiswa
        App\Student::create([
            'nim'            => '2011140026',
            'nama_mahasiswa' => 'Achmad Tantowi',
            'alamat'         => 'Cikoko 1',
            'jk'             => 'L',
            'telp'           => '085752125541',
            'hp'             => '085302155887',
            'agama'          => 'Islam',
            'email'          => 'owi@gmail.com',
            'tempat_lahir'   => 'Tangerang',
            'tanggal_lahir'  => '1990-01-25',
            'prodi_id'       => 1,
            'jurusan_id'     => 5,
            'kelas_id'       => 8,
            'kategori_kelas' => 'REG',
            'aktif'          => 'Y',
            'created_user'   => 'muharik',
            'updated_at'     => null,
        ]);
    }
}
