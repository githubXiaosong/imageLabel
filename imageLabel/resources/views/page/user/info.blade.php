@extends('page.user.template')

@section('title')
    userinfo
@stop

@section('user_js/css')
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script>
    <script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.min.js"></script>

    <script>


        {{--控制模态框的js--}}
        function modal_change_nickname() {
            $("#modal-change-nickname").modal("show")
        }
        function modal_change_phone() {
            $("#modal-change-phone").modal("show")
        }
        function modal_change_email() {
            $("#modal-change-email").modal("show")
        }


        $().ready(function () {
            var validator = $("#change-nickname-form").validate({
                rules: {
                    nickname: {
                        required: true,
                        minlength: 6,
                        maxlength: 24
                    }


                },
                messages: {},

                submitHandler: function (form) {
//                    alert(1);

//                    特么的是这个form而不是那个this
                    $(form).ajaxSubmit({
                        type: 'get', // 提交方式 get/post
                        url: '/api/changeNickname', // 需要提交的 url
                        success: function (data) { // data 保存提交后返回的数据，一般为 json 数据
                            console.log(data);
                            if (data.status == 0) {
                                //刷新页面
//                                window.location.reload();
                                window.location.href = '/';
                            } else {
                                var errors = {};
                                //请在这写一下服务器发回的数据和客户端对应数据的名称键值对
                                var server_client_items = {nickname: 'nickname'};

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
    </script>
@stop

@section('user_content')
    <div class="col-md-6">
        <table class="table">
            <tr>
                <td class="c-black f-18">用户名</td>
                <td class="c-666 f-18">{{$user->nickname?:'暂无'}}</td>
                <td>
                    <input class="btn btn-default radius" type="button" onClick="modal_change_nickname()" value="修改">
                </td>
            </tr>
            <tr>
                <td class="c-black f-18">手机号</td>
                <td class="c-666 f-18">{{$user->phone?:'暂无'}}</td>
                <td>
                    <input class="btn btn-default radius" type="button" onClick="modal_change_phone()" value="修改">
                </td>
            </tr>
            <tr>
                <td class="c-black f-18">邮箱</td>
                <td class="c-666 f-18">{{$user->email?:'暂无'}}</td>
                <td>
                    <input class="btn btn-default radius" type="button" onClick="modal_change_email()" value="修改">
                </td>
            </tr>
            <tr>
                <td class="c-black f-18">身份</td>
                <td class="c-666 f-18">{{$user->identity->title}}</td>
            </tr>
            <tr>
                <td class="c-black f-18">账号状态</td>
                <td class="c-666 f-18">{{$user->status->title}}</td>
            </tr>
            <tr>
                <td class="c-black f-18">创建时间</td>
                <td class="c-666 f-18">{{session('user')->created_at?:'暂无'}}</td>
            </tr>
        </table>

    </div>

    {{--模态框内容开始--}}
    <div id="modal-change-nickname" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form id="change-nickname-form" class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title">修改用户名</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body col-9">
                    <input type="text" class="input-text radius size-M" id="nickname" name="nickname"
                           value="{{$user->nickname?:''}}">
                </div>
                {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">确定</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-change-phone" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title">对话框标题</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <p>对话框内容…</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">确定</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </form>
        </div>
    </div>
    <div id="modal-change-email" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content radius">
                <div class="modal-header">
                    <h3 class="modal-title">对话框标题</h3>
                    <a class="close" data-dismiss="modal" aria-hidden="true" href="javascript:void();">×</a>
                </div>
                <div class="modal-body">
                    <p>对话框内容…</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">确定</button>
                    <button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>
                </div>
            </form>
        </div>
    </div>
    {{--模态框内容结束--}}


@stop
