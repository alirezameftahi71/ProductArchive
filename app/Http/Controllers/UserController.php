<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends BaseController
{
    public function all(Request $request)
    {
        return $this->baseAll(User::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(User::class, $id);
    }
}
