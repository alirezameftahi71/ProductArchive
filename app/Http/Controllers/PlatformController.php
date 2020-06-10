<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Platform;

class PlatformController extends BaseController
{
    public function all(Request $request)
    {
        return $this->baseAll(Platform::class, $request);
    }

    public function show($id)
    {
        return $this->baseShow(Platform::class, $id);
    }
}
