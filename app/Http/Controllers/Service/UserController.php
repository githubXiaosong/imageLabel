<?php

namespace App\Http\Controllers\Service;


use App\Http\Requests;
use App\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * @return array 注册应该需要的是手机验证码  这里注意要给前端写一个请于两分钟之内填写 因为session的时间比较短了
     */
    public function register()
    {
        $validator = Validator::make(
            rq(),
            [
                'phone' => 'required|unique:users,phone|numLength11|samePhone',
                'password' => 'required|min:6|max:16|alpha_num',
                'sms_code' => 'required|min:4|max:4|sameSMS'
            ],
            [

            ]
        );
        if ($validator->fails())
            return err(1, $validator->messages());

        $hashed_password = Hash::make(rq('password'));
        $user = new User();
        $user->password = $hashed_password;
        $user->phone = rq('phone');
        if ($user->save())
            return suc();
        else
            return err(SERIOUS_ERROR_DB);
    }


    public function login()
    {
        //校验参数 账号密码验证码 省的攻击 先做手机登录
        $validator = Validator::make(
            rq(),
            [
                'phone' => 'required|validatePhonePassword',
                'password' => 'required|min:6|max:24',
            ],
            [

            ]
        );
        if ($validator->fails())
            return err(1, $validator->messages());
        $user = DB::table('users')->where('phone', rq('phone'))->first();
        session(['user' => $user]);
        return suc();
    }


    /**
     * 修改用户名
     */
    public function changeNickName()
    {
        //不用验证id 方式session验证之中去 直接进行登录限制
        $validator = Validator::make(
            rq(),
            [
                'nickname' => 'required|min:6|max:24',
            ],
            [

            ]
        );

        if ($validator->fails())
            return err(1, $validator->messages());

        DB::table('users')->where('id', session('user')->id)->update(['nickname' => rq('nickname')]);

        return suc();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * session 好像是按照机器码进行隔离的
     */
    public function logout()
    {
        Session::flush();
        return redirect('/');
    }
}
