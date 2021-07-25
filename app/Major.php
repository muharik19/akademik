<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'id', 'kode_jurusan', 'prodi_id', 'nama_jurusan', 'last_update_user', 'created_user', 'dosen_id', 'aktif', 'updated_at',
    ];
}
