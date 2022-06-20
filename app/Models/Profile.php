<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $fillable = [
        'id',
        'user_id',
        'jk',
        'tmp_lahir',
        'tgl_lahir',
        'alamat',
        'status',
        'pekerjaan',
        'foto',

    ];
    public function pengurus()
    {
      return $this->belongsTo('App\Models\pengurus');
    }
  
    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }
}