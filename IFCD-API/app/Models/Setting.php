<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'comNumber',
        'comEmail',
        'approveEmail',
        'urlBase',
        'linkedInClientID',
        'linkedInRedirectUri',
        'linkedInClientSecret',
        'linkedInScope',
        'tweeterClientID',
        'tweeterClientSecret',
        'roles'
    ];


    protected $casts = [
        'roles' => 'json'
    ];
}
