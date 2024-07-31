<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaires extends Model
{
    use HasFactory;


    public function adminstrateurs(){
        return $this->belongsToMany(User::class, 'partenaire_user', 'partenaires_id', 'user_id');

    }
}
