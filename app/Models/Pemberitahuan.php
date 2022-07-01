<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemberitahuan extends Model
{
    use HasFactory;
    protected $table = 'pemberitahuan';
    protected $fillable = [
        'id',
        'anggota_id',
    'pengurus_id',
        'keterangan',
        'kategori',
        'status',

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
