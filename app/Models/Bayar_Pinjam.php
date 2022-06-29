<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bayar_Pinjam extends Model
{
    use HasFactory;

    protected $table = "bayar_pinjam";
    protected $fillable = [
        'id',
        'pengeluaran_id',
        'jumlah_bayar',
        'pembayaran'
    ];

    public function pengeluaran()
    {
      return $this->hasOne('App\Models\Pengeluaran');
    }
  
    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }
  
}
