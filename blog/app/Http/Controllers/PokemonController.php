<?php

namespace App\Http\Controllers;

use App\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        $_GET['filter'] = $_GET['filter'] ?? 'all';
        
        $query = Pokemon::with('abilities')->orderBy('weight','desc');

        if($_GET['filter'] == 'heavy') {
            $query->where('weight', '>', 199);
        } elseif($_GET['filter'] == 'light') {
            $query->whereBetween('weight', [100,150]);
        } elseif($_GET['filter'] == 'medium') {
            $query->where('weight', '>', 151)->where('weight', '<=', 199);
        }

        $pokemons = $query->paginate(10);

        return view("pokemons", compact("pokemons"));
    }

    public function search($name)
    {
        dd($name);
        $pokemon = Pokemon::with('abilities')->where('weight', 'like', "%$name%")->first();
        return view("pokemon_detail", compact("pokemon"));
    }

    public function store(Request $request)
    {
        // Create a new Pokemon
    }

    public function update(Request $request, $id)
    {
        // Update an existing Pokemon
    }

    public function destroy($id)
    {
        // Delete a Pokemon
    }
}
