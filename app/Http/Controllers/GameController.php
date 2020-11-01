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

class GameController extends BaseController
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
            return $this->serverError();
        }
    }

    public function show($id)
    {
        try {
            $game = Game::with('genres', 'platforms', 'publishers')->find($id);
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->serverError();
        }
    }

    public function destroy(Game $game)
    {
        try {
            $game->delete();
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->serverError();
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
                $genres = $this->CreateOrFetchIdsByNames(Genre::class, $genre_names);
                $game->genres()->sync($genres);
            } else {
                $game->genres()->sync([]);
            }

            if (request('platforms')) {
                $platform_names = explode(',', request('platforms'));
                $platforms = $this->CreateOrFetchIdsByNames(Platform::class, $platform_names);
                $game->platforms()->sync($platforms);
            } else {
                $game->platforms()->sync([]);
            }

            if (request('publishers')) {
                $publisher_names = explode(',', request('publishers'));
                $publishers = $this->CreateOrFetchIdsByNames(Publisher::class, $publisher_names);
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
            return $this->serverError();
        }
    }

    public function toggleChecked(Game $game)
    {
        try {
            $game->checked = $game->checked == false;
            $game->save();
            return response()->json($game, 200);
        } catch (\Throwable $th) {
            return $this->serverError();
        }
    }

    
    private function CreateOrFetchIdsByNames($class, $item_names)
    {
        $res = array();
        foreach ($item_names as $item_name) {
            $item = $class::firstOrCreate(['name' => $item_name]);
            $res[] = $item->id;
        }
        return $res;
    }
}
