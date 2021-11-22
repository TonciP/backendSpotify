<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class artista extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre', 'genero_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function genero()
    {
        return $this->belongsTo(genero::class);
    }

    public function canciones()
    {
        return $this->hasMany(biblioteca::class);
    }
}
