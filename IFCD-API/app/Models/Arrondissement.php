<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arrondissement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'commune_id'
    ];

    public function commune(){
        return $this->belongsTo(Commune::class);
    }

    public function villages(){
        return $this->hasMany(Village::class);
    }
}
