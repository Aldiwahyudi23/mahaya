<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = "kehadirans";

    protected $fillable = [
        'Kehadiran',
        'siapa',
        'alasan',
        'tanggapan',
        'anggota_id',
    ];

    public function anggota()
    {
        return $this->belongsTo('App\Models\User');
    }

}
