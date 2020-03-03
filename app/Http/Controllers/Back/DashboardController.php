<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all')->only('index');
    }

    public function index()
    {
        return view('dashboard');
    }
}
