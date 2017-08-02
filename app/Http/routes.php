<?php
function rq($key = null)
{
    return ($key == null) ? Request::all() : Request::get($key);
}

function suc($data = null)
{
    $ram = ['status' => 0];
    if ($data) {
        $ram['data'] = $data;
        return $ram;
    }
    return $ram;
}

function err($code, $data = null)
{
    if ($data)
        return ['status' => $code, 'data' => $data];
    return ['status' => $code];
}

function get_limit_and_skip($limit = null)//是不穿为空 而不是穿了null为空
{
    $limit = $limit ?: 15;
    return ['limit' => $limit, 'skip' => (rq('page') ? (rq('page') - 1) : 0) * $limit];
}


Route::group(['middleware' => ['web']], function () {
    /**
     *   测试API
     */
    Route::any('test', 'CommonController@test');

    /**
     * 返回view页面
     */
    Route::get('/', 'Page\HomeController@index');
    Route::get('register', 'Page\HomeController@register');
    Route::get('login', 'Page\HomeController@login');
    Route::group(['middleware' => ['checkAuth']], function () {
        Route::get('imageGroups', 'Page\ImageController@groups');
        Route::get('imageList', 'Page\ImageController@lists');
        Route::group(['prefix' => 'user'], function () {
            Route::get('info', 'Page\UserController@info');
            Route::get('work', 'Page\UserController@work');
            Route::get('bill', 'Page\UserController@bill');
        });
    });

    /**
     * 服务  这边的接口都需要添加csrf校验
     */
    Route::group(['prefix' => 'api'], function () {
        Route::get('createCode', 'Service\ValidateController@createCode');
        Route::post('sendSMS', 'Service\ValidateController@sendSMS');
        Route::post('register', 'Service\UserController@register');
        Route::post('login', 'Service\UserController@login');
        Route::post('logout','Service\UserController@logout');
        Route::group(['middleware' => ['checkAuth']], function () {
            Route::any('logout', 'Service\UserController@logout');
            Route::post('addWork', 'Service\ImageController@addWork');
            Route::post('removeWork', 'Service\ImageController@removeWork');//还没有测试post请求
            Route::post('getUpLoadSign', 'Service\GlobalController@getUpLoadSign');//还没有测试post请求
            Route::post('getImageGroups', 'Service\ImageController@getImageGroups');//还没有测试post请求
            Route::any('changeNickname', 'Service\UserController@changeNickName');//还没有测试post请求
        });
    });
});
