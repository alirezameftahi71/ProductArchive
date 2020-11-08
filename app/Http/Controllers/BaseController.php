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
            return $this->successResponse($class::all());
        } catch (\Throwable $th) {
            return $this->serverErrorResponse();
        }
    }

    public function baseSearchByName($class, $search)
    {
        try {
            $res = $class::where('name', 'like', '%' . $search . '%')->get();
            return $this->successResponse($res);
        } catch (\Throwable $th) {
            return $this->serverErrorResponse();
        }
    }

    public function baseShow($class, $id)
    {
        try {
            return $this->successResponse($class::find($id));
        } catch (\Throwable $th) {
            return $this->serverErrorResponse();
        }
    }

    public function serverErrorResponse(string $message = 'Server Error.')
    {
        return response()->json(['message' => $message], 500);
    }

    public function successResponse($data)
    {
        return response()->json($data, 200);
    }
}
