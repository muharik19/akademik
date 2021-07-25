<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // protected $table = 'schedules';
    protected $fillable = [
        'id', 'jurusan_id', 'makul_id', 'kategori_jadwal', 'ruang', 'kelas_id','hari','jam_mulai','jam_selesai','dosen_id','created_user','last_update_user', 'updated_at',
    ];
}
