<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GameController extends Controller
{
    public function all()
    {
        $games = Game::with('genres', 'platforms', 'publishers')->get();
        return response()->json($games, 200);
    }

    public function show($id)
    {
        $game = Game::with('genres', 'platforms', 'publishers')->find($id);
        if (!$game) {
            throw new ModelNotFoundException;
        }
        return response()->json($game, 200);
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json($game, 204);
    }

    public function toggleChecked(Game $game)
    {
        $game->checked = $game->checked == 0 ? 1 : 0;
        $game->save();
        return response()->json($game, 204);
    }
}
