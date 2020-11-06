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
            DB::commit();
            return $this->successResponse($userList);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverErrorResponse();
        }
    }

    public function update(UserList $userList)
    {
        $inputObject = [
            'name' => request('name'),
        ];

        DB::beginTransaction();
        try {
            $userList->update($inputObject);
            DB::commit();
            return $this->successResponse($userList);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverErrorResponse();
        }
    }

    public function markFavorite(Game $game)
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
        $exists = $userList->games->contains($game->id);
        return $exists;
    }

    private static function getUserListForCurrentUser($name)
    {
        return UserList::where([['user_id', '=', Auth::user()->id], ['name', '=', $name]])->first();
    }

    private static function createOrFetchUserList($inputObject)
    {
        return UserListController::getUserListForCurrentUser($inputObject['name']) ?? UserList::create($inputObject);
    }

    private static function getUserListsForCurrentUser()
    {
        return UserList::where('user_id', '=', Auth::user()->id)->with('games')->get();
    }
}
