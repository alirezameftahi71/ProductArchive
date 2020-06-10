<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends BaseController
{
    public function all(Request $request)
    {
        return $this->baseAll(Genre::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(Genre::class, $id);
    }
}
