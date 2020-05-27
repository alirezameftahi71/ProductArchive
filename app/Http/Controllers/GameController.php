<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use App\Game;
use App\Genre;
use App\Platform;
use App\Publisher;
use Exception;

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
    
    public function store()
    {
        DB::beginTransaction();
        try {
            $game = Game::create([
                'name' => request('name'),
                'released_date' => request('releasedDate'),
                'rate' => request('rate'),
                'checked' => request('isChecked'),
                'description' => request('description')
            ]);

            if (request('genres')) {
                $genre_names =  explode(',', request('genres'));
                $genres = GameController::fetch_objects_from_strings(Genre::class, $genre_names);
                $game->genres()->sync($genres);
            }

            if (request('platforms')) {
                $platform_names = explode(',', request('platforms'));
                $platforms = GameController::fetch_objects_from_strings(Platform::class, $platform_names);
                $game->platforms()->sync($platforms);
            }

            if (request('publishers')) {
                $publisher_names = explode(',', request('publishers'));
                $publishers = GameController::fetch_objects_from_strings(Publisher::class, $publisher_names);
                $game->publishers()->sync($publishers);
            }

            if (request('coverPic') != null && request('coverPic') != "null") {
                $game->update([
                    'cover_pic' => request('coverPic')->store('uploads', 'public'),
                ]);
            }

            DB::commit();
            return response()->json($game, 200);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function update(Game $game)
    {
        DB::beginTransaction();
        try {
            $game->update([
                'name' => request('name'),
                'released_date' => request('releasedDate'),
                'rate' => request('rate'),
                'checked' => request('isChecked'),
                'description' => request('description')
            ]);

            if (request('genres')) {
                $genre_names =  explode(',', request('genres'));
                $genres = GameController::fetch_objects_from_strings(Genre::class, $genre_names);
                $game->genres()->sync($genres);
            }

            if (request('platforms')) {
                $platform_names = explode(',', request('platforms'));
                $platforms = GameController::fetch_objects_from_strings(Platform::class, $platform_names);
                $game->platforms()->sync($platforms);
            }

            if (request('publishers')) {
                $publisher_names = explode(',', request('publishers'));
                $publishers = GameController::fetch_objects_from_strings(Publisher::class, $publisher_names);
                $game->publishers()->sync($publishers);
            }

            if (request('coverPic') != null && request('coverPic') != "null" && request('coverPic') != "undefined") {
                $game->update([
                    'cover_pic' => request('coverPic')->store('uploads', 'public'),
                ]);
            }

            DB::commit();
            return response()->json($game, 200);
        } catch (Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    public function toggleChecked(Game $game)
    {
        $game->checked = $game->checked == 'false' ? 'true' : 'false';
        $game->save();
        return response()->json($game, 204);
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
