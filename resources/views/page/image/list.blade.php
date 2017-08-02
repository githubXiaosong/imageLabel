@extends('page.template')

@section('title')
    image-list
@stop

@section('js/css')

@stop

@section('content')

    <div class="container forty-padding-top">


        <div class="col-md-10 col-md-offset-1 forty-padding-top cl">
            <div class=" mr-30 mb-20">
                <div class="f-l">
                    <h4>{{rq('category_title')}} &nbsp&nbsp&nbsp
                        <mark>￥{{ rq('money') }}</mark>
                    </h4>
                </div>
                <div class="f-r">
                    <button id="add_work" class=" btn btn-default"><i class="Hui-iconfont">&#xe600;</i>&nbsp&nbsp&nbsp加入我的工作簿</button>
                </div>
                <div class="cl"></div>
            </div>


            @foreach($images as $image)

                <div class="col-md-3 mb-20">
                    <div class="album-img">
                        <img src="{{ $image->url }}"
                             alt="..." class="radius">
                    </div>
                </div>
            @endforeach

        </div>

        <div class="cl"></div>


    </div>

    <script>


        $('#add_work').click(function () {
            $.ajax({
                type: 'post', // 提交方式 get/post
                url: "/api/addWork",
                data: {
                    group_id: '{{rq('group_id')}}',
                    _token: '{{csrf_token()}}'
                },
                success: function (result) {
                    console.log(result);

                    if (result.status == 0) {
                        console.log(result);
                        //做一个自动消失的提示框 提示是添加成功
                        $.Huimodalalert('添加成功！ \"我的工作簿中\" 查看', 2000);
                    } else {
                        //做一个自动消失的提示框 提示是添加失败 并且写入log文件
                        $.Huimodalalert('添加失败！错误码 '+ result.status +'', 2000);
                    }
                }
            });
        })



    </script>
@stop
