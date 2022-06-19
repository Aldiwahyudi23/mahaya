<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengurus extends Model
{
    use HasFactory;

    protected $table = 'pengurus';
    protected $fillable = [
        'id',
        'nama_pengurus',
        'deskripsi',

    ];
    public function anggota()
    {
      return $this->belongsTo('App\Models\User');
    }
  
    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }
}
