<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="/lib/html5shiv.js"></script>
    <script type="text/javascript" src="/lib/respond.min.js"></script>
    <link href="/h-ui/css/H-ui.ie.css" rel="stylesheet" type="text/css"/>
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="/lib/Hui-iconfont/1.0.8/iconfont.min.css"/>
    <link rel="stylesheet" type="text/css" href="/css/base.css"/>

    <script type="text/javascript" src="/lib/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/h-ui/js/H-ui.min.js"></script>

    @yield('js/css')

    <title>@yield('title')</title>
</head>

<body>

@section('navbar')
    <header class="navbar-wrapper">
        <div class="navbar navbar-black navbar-fixed-top">
            <div class="container cl"><a class="logo navbar-logo hidden-xs" href="{{url('/')}}">imageLabel</a> <a
                        class="logo navbar-logo-m visible-xs" href="/aboutHui.shtml">H-ui</a> <a aria-hidden="false"
                                                                                                 class="nav-toggle Hui-iconfont visible-xs"
                                                                                                 href="javascript:;">
                    &#xe667;</a>
                <nav class="nav navbar-nav nav-collapse" role="navigation" id="Hui-navbar">
                    <ul class="cl">
                        <li class="current"><a href="{{url('/')}}" target="_blank">首页</a></li>
                        <li><a href="{{url('/imageGroups')}}" >图片组</a></li>
                        <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A">工具 <i
                                        class="Hui-iconfont">&#xe6d5;</i></a>
                            <ul class="dropDown-menu menu radius box-shadow">
                                <li><a href="http://www.h-ui.net/bug.shtml" target="_blank">Bug兼容性汇总</a></li>
                                <li><a href="http://www.h-ui.net/websafecolors.shtml" target="_blank">web安全色</a></li>
                                <li><a href="http://www.h-ui.net/Hui-3.7-Hui-iconfont.shtml" target="_blank">Hui-iconfont</a>
                                </li>
                                <li><a href="javascript:;">web工具箱<i class="arrow Hui-iconfont">&#xe6d7;</i></a>
                                    <ul class="menu">
                                        <li><a href="http://www.h-ui.net/tools/jsformat.shtml" target="_blank">JS/HTML格式化工具</a>
                                        <li><a href="http://www.h-ui.net/tools/HTMLtoJS.shtml" target="_blank">HTML/JS转换工具</a>
                                        <li><a href="http://www.h-ui.net/tools/cssformat.shtml" target="_blank">CSS代码格式化工具</a>
                                        <li><a href="http://www.h-ui.net/tools/daxiaoxie.shtml" target="_blank">字母大小写转换工具</a>
                                        <li><a href="http://www.h-ui.net/tools/fantizhuanhuan.shtml" target="_blank">繁体字、火星文转换</a>
                                        <li><a href="javascript:;">三级菜单<i class="arrow Hui-iconfont">&#xe6d7;</i></a>
                                            <ul class="menu">
                                                <li><a href="javascript:;">四级菜单</a></li>
                                                <li><a href="javascript:;">四级菜单</a></li>
                                                <li><a href="javascript:;">四级菜单</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">三级导航</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">二级导航</a></li>
                                <li class="disabled"><a href="javascript:;">二级菜单</a></li>
                            </ul>
                        </li>
                        @if ( \Illuminate\Support\Facades\Session::has('user'))
                            {{--<li class="f-r"><a href="http://h-ui.net/aboutHui.shtml"--}}
                            {{--target="_blank">{{ \Illuminate\Support\Facades\Session::get('user')->phone }}</a>--}}

                            <li class="dropDown dropDown_hover f-r"><a href="javascript:;"
                                                                       class="dropDown_A">{{ \Illuminate\Support\Facades\Session::get('user')->phone }}
                                    <i class="Hui-iconfont">&#xe6d5;</i></a>
                                <ul class="dropDown-menu menu radius box-shadow">
                                    <li><a href="{{url('/user/info')}}"><i class="Hui-iconfont">&#xe705;</i>&nbsp&nbsp&nbsp
                                            个人中心</a></li>
                                    <li><a href="http://www.h-ui.net/websafecolors.shtml" target="_blank"><i
                                                    class="Hui-iconfont">&#xe626;</i>&nbsp&nbsp&nbsp工作薄</a>
                                    </li>
                                    <li><a href="http://www.h-ui.net/Hui-3.7-Hui-iconfont.shtml" target="_blank"><i
                                                    class="Hui-iconfont">&#xe622;</i>&nbsp&nbsp&nbsp通知</a>
                                    </li>
                                    <li><a href="#"><i class="Hui-iconfont">&#xe627;</i>&nbsp&nbsp&nbsp账单</a></li>
                                    <li><a href="{{url('/api/logout')}}"><i class="Hui-iconfont">&#xe627;</i>&nbsp&nbsp&nbsp退出</a></li>
                                </ul>
                            </li>

                        @else
                            <li class="f-r"><a href="/login">登录</a></li>
                            <li class="f-r"><a href="/register">注册</a></li>
                        @endif
                    </ul>
                </nav>
                <nav class="navbar-userbar hidden-xs"></nav>
            </div>
        </div>
    </header>
@show


<div style="min-height: 600px">
    @yield('content')
</div>


@section('end')
    <footer class="footer mt-20">
        <div class="container-fluid">
            <nav><a href="#" target="_blank">关于我们</a> <span class="pipe">|</span> <a href="#" target="_blank">联系我们</a>
                <span class="pipe">|</span> <a href="#" target="_blank">法律声明</a></nav>
            <span class="pipe"></span> <a href="#" target="_blank">备案号: 冀ICP备17020724</a></nav>

            <p>河北科技大学@小松 <br>
            </p>
        </div>
    </footer>
@show

</body>
</html>
