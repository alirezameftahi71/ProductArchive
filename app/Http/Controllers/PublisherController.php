<?php

namespace App\Http\Controllers;
use App\Publisher;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function all(Request $request)
    {
        if ($request->has('search')) {
            return Publisher::where('name', 'like', '%' . $request->input('search') . '%')->get();
        }
        return Publisher::all();
    }

    public function show($Publisher)
    {
        return Publisher::find($Publisher);
    }
}
