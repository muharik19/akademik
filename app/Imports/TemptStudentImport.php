<?php

namespace App\Imports;

use App\Temp_student;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; //TAMBAHKAN CODE 
use App\Student;

class TemptStudentImport implements ToModel, WithHeadingRow // USE CLASS YANG DIIMPORT
{
    protected $prodi_id;
    protected $jurusan_id;
    protected $kelas_id;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function __construct($prodi_id, $jurusan_id, $kelas_id)
    {
        $this->prodi_id   = $prodi_id; //MENERIMA PARAMETER YANG DIKIRIM
        $this->jurusan_id = $jurusan_id; //MENERIMA PARAMETER YANG DIKIRIM
        $this->kelas_id   = $kelas_id; //MENERIMA PARAMETER YANG DIKIRIM
    }

    public function model(array $row)
    {
        $user_name = Auth::user()->username;
        $nim        = $row['nim'];
        $nama       = $row['nama_mahasiswa'];
        $keterangan = null;
        $cari       = Temp_student::where('nim', $nim)->get();
        $cariS      = Student::where('nim', $nim)->get();
        if (empty($nim) && empty($nama)) {
            $keterangan = 'Tidak ada NIM dan Nama Lengkap';
        } elseif (empty($nim)) {
            $keterangan = 'Tidak ada NIM';
        } elseif (empty($nama)) {
            $keterangan = 'Tidak ada Nama Lengkap';
        } elseif ($cari->count() > 0) {
            $keterangan = 'Duplikat NIM di Data Excel';
        } elseif ($cariS->count() > 0) {
            $keterangan = 'Duplikat Data NIM di Database';
        }
        return new Temp_student([
            'nim'            => $nim,
            'nama_mahasiswa' => $nama,
            'alamat'         => $row['alamat'],
            'jk'             => $row['jk'],
            'telp'           => $row['telp'],
            'hp'             => $row['hp'],
            'agama'          => $row['agama'],
            'email'          => $row['email'],
            'tempat_lahir'   => $row['tempat_lahir'],
            'tanggal_lahir'  => date('Y-m-d', strtotime($row['tanggal_lahir'])),
            'prodi_id'       => $this->prodi_id,
            'jurusan_id'     => $this->jurusan_id,
            'kelas_id'       => $this->kelas_id,
            'aktif'          => $row['aktif'],
            'kategori_kelas' => $row['kelas'],
            'tanggal_upload' => date('Y-m-d'),
            'created_user'   => $user_name,
            'updated_at'     => null,
            'keterangan'     => $keterangan
        ]);
    }
}
