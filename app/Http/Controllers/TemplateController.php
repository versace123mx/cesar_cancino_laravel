<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function template_inicio(){
        return view('templates.home');
    }

}
