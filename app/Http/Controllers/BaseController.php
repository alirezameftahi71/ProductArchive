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
        return $this->getAll($class);
    }

    public function getAll($class)
    {
        try {
            return response()->json($class::all(), 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function baseSearchByName($class, $search)
    {
        try {
            $res = $class::where('name', 'like', '%' . $search . '%')->get();
            return response()->json($res, 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function baseShow($class, $id)
    {
        try {
            return response()->json($class::find($id), 200);
        } catch (\Throwable $th) {
            return $this->servereError();
        }
    }

    public function servereError(string $message = 'Server Error.')
    {
        return response()->json(['message' => $message], 500);
    }
}
