<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;

class PlatformController extends Controller
{
    public function all(Request $request)
    {
        if ($request->has('search')) {
            return Platform::where('name', 'like', '%' . $request->input('search') . '%')->get();
        }
        return Platform::all();
    }

    public function show($platform)
    {
        return Platform::find($platform);
    }
}
