<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokemonAbility extends Model
{
    protected $table = 'pokemon_ability';

    public function pokemon()
    {
        return $this->belongsTo(Pokemon::class, 'pokemon_id');
    }

    public function ability()
    {
        return $this->belongsTo(Ability::class, 'ability_id');
    }
}
