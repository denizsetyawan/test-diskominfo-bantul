<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    protected $table = 'pokemons';

    public function abilities()
    {
        return $this->hasMany(PokemonAbility::class);
    }
}
