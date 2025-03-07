<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class AdminController extends Controller
{
    public function admin(){ return view('admin.dashboard'); }
}
