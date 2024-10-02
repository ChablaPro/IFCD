<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
            'titre',
            'objectif',
            'type',
            'domaine',
            'pays',
            'etat',
            'commune',
            'bassin',
            'date',
            'lieu',
            'state',
            'picture',
            'user_id'
    ];

    public function actors(){
        return $this->belongsToMany(Actor::class, 'actorevents');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
