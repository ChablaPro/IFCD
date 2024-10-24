<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'avatar',
        'genre',
        'age',
        'langue',
        'niveau',
        'compagny_id',
        'user_id',
        'state',
        'superficie', 
        'handicap', 
        'occupation', 
        'nbrBetail'
    ];

    public function activities(){
        return $this->belongsToMany(Activity::class, 'actorevents');
    }

    public function organisation()
    {
        return $this->belongsTo(Compagny::class, 'compagny_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
