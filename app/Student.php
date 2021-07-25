<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'id', 'nim', 'nama_mahasiswa', 'alamat', 'jk', 'agama','email','telp','hp','tempat_lahir','created_user','last_update_user', 'updated_at', 'tanggal_lahir', 'prodi_id', 'jurusan_id', 'kelas_id', 'kategori_kelas', 'foto', 'aktif',
    ];
}
