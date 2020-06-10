<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publisher;

class PublisherController extends BaseController
{
    public function all(Request $request)
    {
        return $this->baseAll(Publisher::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(Publisher::class, $id);
    }
}
