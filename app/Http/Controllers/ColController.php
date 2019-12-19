<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColController extends Controller
{
    public function col_report()
    {
        return view('col_report');
    }
}
