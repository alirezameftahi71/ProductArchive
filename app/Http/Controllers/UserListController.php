<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\UserList;
use Exception;
use Throwable;

class UserListController extends BaseController
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function all(Request $request)
    {
        return $this->baseAll(UserList::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(UserList::class, $id);
    }

    public function store(Request $request)
    {
        return $this->createUpdateUserList();
    }

    public function update(UserList $userList)
    {
        return $this->createUpdateUserList($userList);
    }

    public function createUpdateUserList(UserList $userList = null)
    {
        $isStoreMode = is_null($userList);
        $inputObject = [
            'name' => request('name') != null ? request('name') : "Favorites",
            'user_id' => Auth::user()->id
        ];

        DB::beginTransaction();
        try {
            if ($isStoreMode) {
                $userList = UserList::create($inputObject);
            } else {
                $userList->update($inputObject);
            }

            if (request('games')) {
                $game_ids = array_map('intval', explode(',', request('games')));
                $userList->games()->sync($game_ids);
            } else {
                $userList->games()->sync([]);
            }
            DB::commit();
            return response()->json($userList, 200);
        } catch (Throwable $th) {
            DB::rollback();
            return $this->serverError();
        }
    }
}
