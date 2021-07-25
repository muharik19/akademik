<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'prodi_id', 'dosen_id', 'kode_makul', 'last_update_user', 'created_user', 'nama_makul', 'semester', 'sks', 'jurusan_id', 'updated_at',
    ];
}
