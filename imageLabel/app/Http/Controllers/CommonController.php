<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class CommonController extends Controller
{
    public function test()
    {
        session()->flush();
        return 0;
        $user = (new User())->where('id',Session::get('user')->id)->with(['identity','status'])->first();
        dd($user->status->title);
//        dd(session('user'));
    }


}
