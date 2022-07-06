<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('front.pages.home', [
            'title' => 'Bunehaba Shop'
        ]);
    }
}
