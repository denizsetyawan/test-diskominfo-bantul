<?php

namespace App\Http\Controllers;

use App\Pokemon;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();
        dd($pokemons->toArray());
        return view("pokemons", compact("pokemons"));
    }

    public function show($id)
    {
        // Get a single Pokemon by ID
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
