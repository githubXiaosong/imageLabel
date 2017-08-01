<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('numLength11', function($attribute, $value, $parameters, $validator) {
            return (strlen($value) == 11) && is_numeric($value);
        });
        Validator::extend('sameCode', function($attribute, $value, $parameters, $validator) {
            return $value == session('validateCode');

        });
        Validator::extend('sameSMS', function($attribute, $value, $parameters, $validator) {
            return true;
            return $value == session('sendSMSCode');

        });
        //防止获取验证码的时候是一个手机 但是提交的时候是另外一个手机
        Validator::extend('samePhone', function($attribute, $value, $parameters, $validator) {
            return true;
            return $value == session('sendSMSCOdePhone');
        });

        Validator::extend('validatePhonePassword', function($attribute, $value, $parameters, $validator) {
            $users = DB::table('users')
                ->where(['phone' => rq('phone')])
                ->first();

            if (!$users)
                return false;

            if (!Hash::check(rq('password'), $users->password)) //一参传过来的password 未加密  二参 加密的密码
                return false;

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
