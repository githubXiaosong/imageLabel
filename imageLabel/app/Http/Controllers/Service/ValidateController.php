<?php

namespace App\Http\Controllers\Service;

use App\Helper\GlobalFunction;
use App\Helper\ValidateCode;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ValidateController extends Controller
{


    /**
     * @return array
     * $phone 发送的手机号
     * 不能随便发送验证码 在这是应该验证验证码是不是正确
     */

    public function sendSMS()
    {
        $validator = Validator::make(rq(),
            [
                'phone' => 'required|numLength11',
//                'code' => 'required|sameCode'
            ],
            [
//                'phone.required' => '手机号不存在',
//                'phone.min' => '手机号长度不正确',
//                'phone.max' => '手机号长度不正确',
//                'phone.integer' => '手机号必须为数字',
//                'code.required' => '验证码必须存在',
//                'code.min' => '验证码长度不正确',
//                'code.max' => '验证码长度不正确',
//                'code.integer' => '验证码必须是数组',
//                'code.same' => '验证码不正确'
            ]);
        if( $validator->fails())
            return err(PARAMS_ERROR,$validator->messages());

        $code =rand(1000,9999);
        $s= new \App\Helper\RongLianYun\SendTemplateSMS();
        $result = $s->sendTemplateSMS(rq('phone') ,array($code,'5'),"1");
        Session::put('sendSMSCode',$code);
        Session::put('sendSMSCOdePhone',rq('phone'));
        if($result->statusCode == 000000)
            return suc();
        return err(PARAMS_ERROR);
    }



    public function createCode()
    {
        $validate = new ValidateCode();
        Session::put('validateCode',$validate->getCode());

        return $validate->doimg();
    }



}
