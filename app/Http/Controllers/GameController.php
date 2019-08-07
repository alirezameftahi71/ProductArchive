<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    public function all()
    {
        $games = Game::with('genres')->with('platforms')->with('publishers')->get();
        return response()->json($games, 200);
    }
    public function show($id)
    {
        $game = Game::with('genres')->with('platforms')->with('publishers')->find($id);
        return response()->json($game, 200);
    }
    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json($game, 204);
    }
}
