@extends('page.template')

@section('title')
    register
@stop

@section('js/css')
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.min.js"></script>
@stop

@section('content')
    <div class="container mt-20">
        <div class="panel panel-default">
            <div class="panel-header "><p class="f-20 text-c va-m">登录   </p> </div>
            <div class="panel-body">
                <form  class="form form-horizontal responsive" id="loginform">

                    <div class="row cl">
                        <label class="form-label col-xs-3">手机：</label>

                        <div class="formControls col-xs-8">
                            <input type="text" class="input-text   size-L" autocomplete="off" placeholder="手机"
                                   name="phone"
                                   id="phone">
                        </div>
                    </div>

                    <div class="row cl">
                        <label class="form-label col-xs-3">密码：</label>

                        <div class="formControls col-xs-8">
                            <input type="password" class="input-text  size-L" autocomplete="off" placeholder="密码"
                                   name="password"
                                   id="password">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="row cl">
                        <div class="col-xs-8 col-xs-offset-3 ">
                            <input class="btn btn-default  size-L" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                            <a href="/register"><p class="c-primary f-r">没有账号? 注册</p></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $().ready(function () {
            var validator=$("#loginform").validate({
                rules: {
                    phone: {
                        required: true,
                        minlength: 11,
                        maxlength:11
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength:16
                    }

                },
                messages: {

                    phone: {
                        required: "请输入用户名",
                        minlength:'长度为11位',
                        maxlength:'长度为11位'
                    },
                    password: {
                        required: "请输入密码",
                    }

                },

                submitHandler: function(form)
                {
//                    alert(1);

//                    特么的是这个form而不是那个this
                    $(form).ajaxSubmit({
                        type: 'post', // 提交方式 get/post
                        url: '/api/login', // 需要提交的 url
                        success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                            console.log(data);
                            if(data.status==0)
                            {
                                //刷新页面
//                                window.location.reload();
                                window.location.href='/';
                            }else{
                                var errors = {};
                                //请在这写一下服务器发回的数据和客户端对应数据的名称键值对
                                var server_client_items = {phone:'phone',password:'password'};

                                for(var i in data.data)
                                {
                                    for(var j in server_client_items)
                                    {
                                        if(i == j)
                                            errors[server_client_items[j]] = data.data[i][0];
                                    }
                                }

                                //把错误数据添加到vilidate之中
                                validator.showErrors(
                                    errors
                                ); //
                            }
                        }
                    });

                }

            })

        });
    </script>

@stop



