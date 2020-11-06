<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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
        $isHearted = UserListController::isHearted($game);
        return view('home', compact('list_items', 'game', 'isHearted'));
    }

    public function create()
    {
        return view('create-edit');
    }

    public function edit($id)
    {
        $game = Game::with('genres', 'platforms', 'publishers')->find($id);
        return view('create-edit', compact('game'));
    }

    public function gridview(Request $request)
    {
        // TODO: refactor this so it won't fetch all in case of filters
        $userLists = UserListController::getUserListsForCurrentUser();
        $selectedUserListId = $request->query('userLists');
        if (!is_null($selectedUserListId)) {
            $collection = DB::table('games')
                ->join('game_user_list', 'game_user_list.game_id', '=', 'games.id')
                ->join('user_lists', 'user_lists.id', '=', 'game_user_list.user_list_id')
                ->select('games.*')
                ->where([
                    ['user_lists.user_id', '=', Auth::user()->id],
                    ['game_user_list.user_list_id', '=', $selectedUserListId],
                ])
                ->get();
        } else {
            $collection = Game::getAll();
        }
        return view('gridview', compact('collection', 'userLists'));
    }

    public function dashboard($id)
    {
        $user = User::find($id);
        return view('dashboard', compact('user'));
    }
}
