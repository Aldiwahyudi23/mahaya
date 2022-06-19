<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggaran extends Model
{
    use HasFactory;

    protected $table = 'anggaran';
    protected $fillable = [
        'id',
        'nama_anggaran',
        'program_id',
        'deskripsi'
    ];

    public function program()
    {
      return $this->belongsTo('App\Models\program');
    }
  
    public function users()
    {
      return $this->belongsTo('App\Models\User');
    }
}
