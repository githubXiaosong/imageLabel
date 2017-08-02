@extends('page.template')

@section('title')
    @yield('user_title')
@stop

@section('js/css')
    @yield('user_js/css')
@stop

@section('content')
    <div class=" col-md-2">
        <aside class="Hui-aside f-l">

            <div class="mt-50 ml-10 no_text-dec">

                <ul>
                    <li><h4><a class="{{ \Illuminate\Support\Facades\Request::is('user/info') ? 'active' : '' }}"
                               href="{{url('user/info')}}">我的信息</a></h4></li>
                    <li><h4><a class="{{ \Illuminate\Support\Facades\Request::is('user/work') ? 'active' : '' }}"
                               href="{{url('user/work')}}">我的工作</a></h4></li>
                    <li><h4><a class="{{ \Illuminate\Support\Facades\Request::is('user/bill') ? 'active' : '' }}"
                               href="{{url('user/bill')}}">我的账单</a></h4></li>
                </ul>

            </div>
        </aside>
        {{--这是一条分割线--}}
        <div style="width: 1px ;height: 300px;background: #000000;" class="f-r"></div>
        <div class="clearer" ></div>
    </div>

    <div class=" col-md-10 mt-20">
        @yield('user_content')
    </div>

    <div class="cl" ></div>
@stop

{{--页头和页脚都要重写才行  现在先放着吧--}}

