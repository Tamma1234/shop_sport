<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;

class BlogController
{
    public function index()
    {
        return view('client.blog.index');
    }

    public function grid()
    {
        return view('client.blog.grid');
    }

    public function list()
    {
        return view('client.blog.list');
    }

    public function detail($slug)
    {
        return view('client.blog.detail', compact('slug'));
    }
}