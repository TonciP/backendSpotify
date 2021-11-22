<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biblioteca extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'titulo_cancion', 'artista_id'];
    protected $hidden = ['created_at', 'updated_at'];

}
