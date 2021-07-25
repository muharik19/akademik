<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    protected $fillable = ['id', 'nim', 'makul_id', 'uts', 'uas', 'nilai', 'sks', 'mutu', 'created_user', 'last_update_user', 'updated_at',];
}
