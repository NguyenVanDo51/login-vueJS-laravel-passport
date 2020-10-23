<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionControllerApi extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request) {
        return $request->user();
    }
}
