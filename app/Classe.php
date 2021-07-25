<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = [
        'jurusan_id', 'nama_kelas', 'last_update_user', 'created_user', 'aktif', 'updated_at',
    ];
}
