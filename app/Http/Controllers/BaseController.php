<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    private $searchQueryString = 'search';

    public function baseAll($class, Request $request)
    {
        if ($request->has($this->searchQueryString)) {
            return $this->baseSearchByName($class, $request->input($this->searchQueryString));
        }
        return response()->json($class::all(), 200);
    }

    public function baseSearchByName($class, $search) {
        $res = $class::where('name', 'like', '%' . $search . '%')->get();
        return response()->json($res, 200);
    }

    public function baseShow($class, $id)
    {
        return response()->json($class::find($id), 200);
    }
}
