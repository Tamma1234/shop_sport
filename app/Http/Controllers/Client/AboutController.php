<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

class AboutController
{
    public function index()
    {
        return view('client.about.index');
    }
}