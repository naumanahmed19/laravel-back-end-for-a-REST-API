<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Apartment;
use App\Category;

class HomeController extends Controller
{

    public function welcome()
    {
        return view('welcome');
    }
}
