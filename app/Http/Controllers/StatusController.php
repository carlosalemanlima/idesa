<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 'UP']);
    }
}
