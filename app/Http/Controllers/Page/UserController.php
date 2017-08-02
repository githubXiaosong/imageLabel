<?php

namespace App\Http\Controllers\Page;

use App\Http\Requests;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function info()
    {
        $user = (new User())->where('id',Session::get('user')->id)->with('identity','status')->first();
        return view('page.user.info')->with(['user'=>$user]);
    }

    public function work()
    {
        return view('page.user.work');
    }

    public function bill()
    {
        return view('page.user.bill');
    }
}
