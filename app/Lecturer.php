<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $table = 'lecturers';
    protected $fillable = [
        'kode_dosen', 'nama_dosen', 'alamat', 'agama', 'aktif', 'updated_at', 'email', 'jk', 'telp', 'hp', 'pendidikanID', 'created_user', 'last_update_user',
    ];
}
