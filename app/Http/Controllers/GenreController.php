<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;

class GenreController extends Controller
{
    public function all(Request $request)
    {
        if ($request->has('search')) {
            return Genre::where('name', 'like', '%' . $request->input('search') . '%')->get();
        }
        return Genre::all();
    }

    public function show($genre)
    {
        return Genre::find($genre);
    }
}
