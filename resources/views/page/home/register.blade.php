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
            <div class="panel-header "><p class="f-20 text-c va-m">注册</p></div>
            <div class="panel-body">
                <form action="" method="post" class="form form-horizontal responsive" id="signupform">

                    <div class="row cl">
                        <label class="form-label col-xs-3">手机：</label>

                        <div class="formControls col-xs-8">
                            <input type="text" class="input-text   size-L" autocomplete="off" placeholder="手机"
                                   name="phone"
                                   id="phone">
                        </div>
                    </div>


                    <div class="row cl">
                        <label class="form-label col-xs-3">短信验证码</label>

                        <div class="formControls col-xs-8 no-padding">
                            <div class=" col-xs-9 ">
                                <input type="text" class="input-text  size-L" autocomplete="off"
                                       placeholder="请输入收到的短信验证码 "
                                       name="sms_code" id="sms_code">
                            </div>
                            <div class=" col-xs-2">
                                <button class="btn size-L  col-xs-2" type="button" id="get_sms_code"
                                        > 获取验证码
                                </button>
                            </div>

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
                    <div class="row cl">
                        <label class="form-label col-xs-3">密码验证：</label>

                        <div class="formControls col-xs-8">
                            <input type="password" class="input-text  size-L" autocomplete="off" placeholder="密码"
                                   name="repassword"
                                   id="repassword">
                        </div>
                    </div>

                    {{ csrf_field() }}
                    <div class="row cl">
                        <div class="col-xs-8 col-xs-offset-3 ">
                            <input class="btn btn-default  size-L" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                            <a href="/login"><p class="c-primary f-r">已有账号? 登录</p></a>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        var validator;
        $().ready(function () {
            validator = $("#signupform").validate({
                rules: {
                    phone: {
                        required: true,
                        minlength: 11,
                        maxlength: 11
                    },

                    sms_code: {
                        required: true,
                        rangelength: [4, 4],
                        digits: true
                    },
                    password: {
                        required: true,
                        minlength: 5,
                        maxlength: 16
                    },
                    repassword: {
                        required: true,
                        equalTo: "#password"
                    }

                },
                messages: {

                    phone: {
                        required: "请输入用户名",
                        minlength: '长度为11位',
                        maxlength: '长度为11位'
                    },
                    password: {
                        required: "请输入密码"
                    }

                },


                submitHandler: function (form) {
//                    alert(1);

//                    特么的是这个form而不是那个this
                    $(form).ajaxSubmit({
                        type: 'post', // 提交方式 get/post
                        url: '/api/register', // 需要提交的 url
                        success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                            console.log(data);
                            if (data.status == 0) {
                                //刷新页面
//                                window.location.reload();
                                window.location.href = '/login';
                            } else {
                                var errors = {};
                                //请在这写一下服务器发回的数据和客户端对应数据的名称键值对
                                var server_client_items = {phone: 'phone', password: 'password', sms_code: 'sms_code'};

                                for (var i in data.data) {
                                    for (var j in server_client_items) {
                                        if (i == j)
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

        $('#get_sms_code').click(function () {
            //设置submit就会直接发送
            if (validator.element(phone)) {
//                console.log($('#phone').val());
                $.ajax({
                    type: 'post', // 提交方式 get/post
                    url: "/api/sendSMS",
                    data: {
                        phone: $('#phone').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (result) {
                        console.log(result);

                        if (result.status == 0) {
                            console.log(result);
                            var num = 60;
                            $('#get_sms_code').addClass('disabled');
//                            $('#get_sms_code').attr('disabled', '');
                            var interval = window.setInterval(function () {
                                $('#get_sms_code').html(--num + 's 重新发送');
                                if (num == 0) {
                                    $('#get_sms_code').removeClass('disabled');
                                    window.clearInterval(interval);
                                    $('#get_sms_code').html('重新发送');
                                }
                            }, 1000);
                        }
                    }
                });
            }
        });


    </script>
@stop