<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    use HasFactory;

    protected $table = 'pemasukan';
    protected $fillable = [
        'user_id',
        'anggota_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'kategori'

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
