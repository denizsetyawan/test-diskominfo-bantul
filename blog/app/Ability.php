<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    protected $table = 'abilities';

    public function pokemonAbilities()
    {
        return $this->hasMany(PokemonAbility::class, 'ability_id');
    }
}
