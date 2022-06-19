<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class program extends Model
{
    use HasFactory;

    protected $table = 'programs';
    protected $fillable = [
        'id',
        'nama_program',
        'pengurus_id',
        'deskripsi',

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
