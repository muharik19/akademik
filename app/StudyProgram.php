<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $table = 'studyprograms';
    protected $fillable = [
        'kode_prodi', 'nama_prodi', 'last_update_user', 'created_user', 'ka_prodi', 'aktif', 'updated_at',
    ];
}
