<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function helper_inicio(){
        return view('helper.home');
    }
}
