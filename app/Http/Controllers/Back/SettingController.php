<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return view('back.settings.index');
    }
}
