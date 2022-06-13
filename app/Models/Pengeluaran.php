<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $table = 'pengeluaran';
    protected $fillable = [
        'user_id',
        'anggota_id',
        'anggaran_id',
        'tanggal',
        'jumlah',
        'keterangan',

    ];

    public function anggaran()
    {
      return $this->belongsTo('App\Models\Anggaran');
    }
    public function anggota()
    {
      return $this->belongsTo('App\Models\User');
    }


}
