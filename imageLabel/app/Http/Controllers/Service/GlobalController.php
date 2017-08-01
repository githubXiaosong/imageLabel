<?php

namespace App\Http\Controllers\Service;


use App\Http\Requests;
use Illuminate\Routing\Controller;
use Tencentyun\Auth;
use Tencentyun\Conf;

class GlobalController extends Controller
{

    //已经挡在的登录之外

    //todo 我特么是不是根本就不用做这个接口 直接拿到图片上传到腾讯云后天就行了 ????? 不对！前端还是要下载图片啊 虽然可能图片的上传可能不同了
    public function getUpLoadSign()
    {
        //todo 检查是不是有权限上传图片权限

        //返回多次签名
        require_once(app_path() . "/Helper/image-php-sdk-master/include.php");
        $bucket = Conf::BUCKET;
        //生成新的多次签名, 可以不绑定资源fileid
        $fileid = '';
        $expired = time() + 999;
        $sign = Auth::getAppSignV2($bucket, $fileid, $expired);
        return suc($sign);
    }

}
