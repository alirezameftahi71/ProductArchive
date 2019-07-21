<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Genre;
use App\Platform;
use App\Publisher;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        $list_items = Game::with('genres')->with('platforms')->with('publishers')->get();
        return view('home', compact('list_items'));
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        \DB::beginTransaction();
        try {
            $game = Game::create([
                'name' => request('name'),
                'released_date' => request('released-date'),
                'rate' => request('rate'),
                'completed' => request('isDone'),
                'description' => request('desc-box')
            ]);

            if (request('hidden-genre')) {
                $genre_names =  explode(',', request('hidden-genre'));
                $genres = HomeController::fetch_objects_from_strings(Genre::class, $genre_names);
                $game->genres()->sync($genres);
            }

            if (request('hidden-platform')) {
                $platform_names = explode(',', request('hidden-platform'));
                $platforms = HomeController::fetch_objects_from_strings(Platform::class, $platform_names);
                $game->platforms()->sync($platforms);
            }

            if (request('hidden-publisher')) {
                $publisher_names = explode(',', request('hidden-publisher'));
                $publishers = HomeController::fetch_objects_from_strings(Publisher::class, $publisher_names);
                $game->publishers()->sync($publishers);
            }
            \DB::commit();
            return redirect('/');
        } catch (\Exception $ex) {
            \DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    private static function fetch_objects_from_strings($class, $item_names)
    {
        $res = array();
        foreach ($item_names as $item_name) {
            $publisher = $class::firstOrCreate(['name' => $item_name]);
            $res[] = $publisher->id;
        }
        return $res;
    }
}
