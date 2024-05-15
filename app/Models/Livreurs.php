<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreurs extends Model
{
    use HasFactory;
    public $incrementing = true; // Pour indiquer que la clé primaire n'est pas auto-incrémentée

    protected $fillable = [
        'adresse',
        'nom',
        'prenom',
        'photo',
        'telephone',
        'sexe',
        'password',
        'photo_permi',
        'situation_matrimoniale',
        'status',
    ];
}
