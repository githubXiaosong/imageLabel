<?php

namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('page.home.index');
    }

    public function register()
    {
        return view('page.home.register');
    }

    public function login()
    {
        return view('page.home.login');
    }
}
