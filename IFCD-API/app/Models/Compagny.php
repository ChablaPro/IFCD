<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compagny extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'newOpa',
        'departement',
        'arrondissement',
        'village',
        'adresse',
        'typeOpa',
        'juridique',
        'denominationOpa',
        'dateCreaction',
        'personneContact',
        'contact',
        'courriel',
        'maillon',
        'totalMembre',
        'nbrHomme',
        'nbrFemme',
        'nbrJFemme',
        'nbrJHomme',
        'services',
        'position',
        'gestionOpa',
        'administrationOpa',
        'surveillanceOpa',
        'bureauOpa',
        'state',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
