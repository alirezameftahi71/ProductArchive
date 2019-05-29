<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;

class GameController extends Controller
{
    public function all()
    {
        return Game::with('genres')->with('platforms')->with('publishers')->get();
    }
    public function show($game)
    {
        return Game::with('genres')->with('platforms')->with('publishers')->find($game);
    }
}
