<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PingController extends Controller
{
    public function ping() {
        return response()->json(['timestamp' => time()], 200);
    }
}