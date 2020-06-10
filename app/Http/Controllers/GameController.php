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
use Throwable;

class GameController extends Controller
{
    public function all(Request $request)
    {
        try {
            if ($request->has('search')) {
                $games = Game::where('name', 'like', '%' . $request->input('search') . '%')
                    ->with('genres', 'platforms', 'publishers')->get();
            } else {
                $games = Game::with('genres', 'platforms', 'publishers')->get();
            }
            return response()->json($games, 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function show($id)
    {
        try {
            $game = Game::with('genres', 'platforms', 'publishers')->find($id);
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function destroy(Game $game)
    {
        try {
            $game->delete();
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function store()
    {
        return $this->createUpdateGame();
    }

    public function update(Game $game)
    {
        return $this->createUpdateGame($game);
    }

    public function createUpdateGame(Game $game = null)
    {
        $isStoreMode = is_null($game);
        $inputObject = [
            'name' => request('name'),
            'released_date' => request('releasedDate'),
            'rate' => request('rate'),
            'checked' => request('checked') == 'true',
            'description' => request('description')
        ];

        DB::beginTransaction();
        try {
            if ($isStoreMode) {
                $game = Game::create($inputObject);
            } else {
                $game->update($inputObject);
            }

            if (request('genres')) {
                $genre_names =  explode(',', request('genres'));
                $genres = GameController::fetch_objects_from_strings(Genre::class, $genre_names);
                $game->genres()->sync($genres);
            } else {
                $game->genres()->sync([]);
            }

            if (request('platforms')) {
                $platform_names = explode(',', request('platforms'));
                $platforms = GameController::fetch_objects_from_strings(Platform::class, $platform_names);
                $game->platforms()->sync($platforms);
            } else {
                $game->platforms()->sync([]);
            }

            if (request('publishers')) {
                $publisher_names = explode(',', request('publishers'));
                $publishers = GameController::fetch_objects_from_strings(Publisher::class, $publisher_names);
                $game->publishers()->sync($publishers);
            } else {
                $game->publishers()->sync([]);
            }

            if (request('coverPic') != null && request('coverPic') != "null" && request('coverPic') != "undefined") {
                $game->update([
                    'cover_pic' => request('coverPic')->store('uploads', 'public'),
                ]);
            }

            DB::commit();
            return response()->json($game, 200);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->servereError();
        }
    }

    public function toggleChecked(Game $game)
    {
        try {
            $game->checked = $game->checked == false;
            $game->save();
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->servereError();
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
