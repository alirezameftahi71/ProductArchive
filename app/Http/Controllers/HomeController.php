<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\User;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $list_items = Game::getAll();
        $game = $request->query('id') ? $list_items->find($request->query('id')) : $list_items->first();
        return view('home', compact('list_items', 'game'));
    }

    public function create()
    {
        return view('create');
    }

    public function edit($id)
    {
        $game = Game::with('genres', 'platforms', 'publishers')->find($id);
        return view('edit', compact('game'));
    }

    public function gridview(Request $request)
    {
        // TODO: refactor this so it won't fetch all in case of filters
        $collection = Game::getAll();
        if ($request->query('is-unchecked') == 'true') {
            $collection = $collection->filter(function ($item) {
                return ($item->checked == false);
            })->values();
        }
        if ($request->query('high-rate') == 'true') {
            $collection = $collection->filter(function ($item) {
                return ($item->rate >= '4');
            })->values();
        }
        return view('gridview', compact('collection'));
    }

    public function dashboard($id)
    {
        $user = User::find($id);
        return view('dashboard', compact('user'));
    }
}
