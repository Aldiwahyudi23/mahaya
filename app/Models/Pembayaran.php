<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'uang';
    protected $fillable = [
        'id',
        'kategori',
        'tanggal',
        'jumlah',
        'keterangan',

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
