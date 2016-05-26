<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LoadController extends Controller
{
    public function getList()
    {
        return view('load.list');
    }

    public function create()
    {
        return view('load.create'); 
    }
}
