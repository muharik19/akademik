<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Temp_student extends Model
{
    protected $table = 'temp_students';
    protected $fillable = ['nim','nama_mahasiswa','alamat', 'jk','telp','hp', 'agama','email','tempat_lahir', 'tanggal_lahir','prodi_id','jurusan_id','kelas_id','kategori_kelas','aktif','tanggal_upload','created_user', 'updated_at','keterangan','created_at'];
}
