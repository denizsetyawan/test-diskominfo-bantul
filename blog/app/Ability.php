<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $table = 'abilities';

    public function pokemons()
    {
        return $this->belongsToMany(Pokemon::class,'pokemon_ability','abilities_id','pokemon_id');
    }
}
