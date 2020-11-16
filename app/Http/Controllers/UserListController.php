<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\UserList;
use App\Game;
use Throwable;

class UserListController extends BaseController
{
    public function all(Request $request)
    {
        return $this->baseAll(UserList::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(UserList::class, $id);
    }

    public function store()
    {
        $inputObject = [
            'name' => request('name'),
            'user_id' => Auth::user()->id
        ];

        DB::beginTransaction();
        try {
            $userList = $this->createOrFetchUserList($inputObject);
            $userList = UserList::with('games')->where('id', $userList->id)->first();
            DB::commit();
            return $this->successResponse($userList);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverErrorResponse();
        }
    }

    public function update(UserList $list)
    {
        $inputObject = [
            'name' => request('name'),
        ];

        DB::beginTransaction();
        try {
            $list->update($inputObject);
            DB::commit();
            return $this->successResponse($list);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverErrorResponse();
        }
    }

    public function addItem()
    {
        $list_id = request('list_id');
        $game_ids = request('game_ids');

        DB::beginTransaction();
        try {
            $userList = UserList::with('games')->where('id', $list_id)->first();
            $userList->games()->syncWithoutDetaching($game_ids);
            DB::commit();
            return $this->successResponse($userList);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverErrorResponse();
        }
    }

    public function heartItem(Game $game)
    {
        $inputObject = [
            'name' => "Favorites",
            'user_id' => Auth::user()->id
        ];

        $userList = $this->createOrFetchUserList($inputObject);
        $hearted = $userList->games()->toggle($game->id);
        return $this->successResponse(!empty($hearted['attached']));
    }

    public static function isHearted(Game $game)
    {
        $userList = UserListController::getUserListForCurrentUser("Favorites");
        if (!is_null($userList)) {
            return $userList->games->contains($game->id);
        }
        return false;
    }

    private function createOrFetchUserList($inputObject)
    {
        return UserListController::getUserListForCurrentUser($inputObject['name']) ?? UserList::create($inputObject);
    }

    public static function getUserListsForCurrentUser()
    {
        return UserList::where('user_id', '=', Auth::user()->id)->with('games')->get();
    }

    private static function getUserListForCurrentUser($name)
    {
        return UserList::where([['user_id', '=', Auth::user()->id], ['name', '=', $name]])->first();
    }
}
