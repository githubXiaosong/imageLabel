@extends('page.template')

@section('title')
    home
@stop

@section('js/css')
    <script type="text/javascript" src="http://lib.h-ui.net/jquery.SuperSlide/2.1.1/jquery.SuperSlide.min.js"></script>
@stop

@section('content')
    <div id="slider-3">
        <div class="slider">
            <div class="bd">
                <ul>
                    <li><a href="http://www.h-ui.net/" target="_blank"><img src="temp/banner1.jpg"></a></li>
                    <li><a href="http://www.h-ui.net/zhaoshang.shtml" target="_blank"><img src="temp/banner2.jpg"></a>
                    </li>
                    <li><a href="http://h-ui.net/H-ui.admin.shtml" target="_blank"><img src="temp/banner3.jpg"></a></li>
                </ul>
            </div>
            <ol class="hd cl dots">
                <li>1</li>
                <li>2</li>
                <li>3</li>
            </ol>
        </div>
    </div>

    <div style="padding-left: 60px;padding-right: 60px">
        <div class="col-md-6 col-md-offset-3 forty-padding-top">
            <div class=" thumbnail f-l">
                <a><img src="/img/test2.jpg" alt="..."></a>
            </div>
            <div class=" thumbnail f-r">
                <a><img src="/img/test2.jpg" alt="..."></a>
            </div>
        </div>
        <div class="col-md-6 col-md-offset-3 forty-padding-top">
            <div class=" thumbnail f-l">
                <a><img src="/img/test2.jpg" alt="..."></a>
            </div>
            <div class=" thumbnail f-r">
                <a><img src="/img/test2.jpg" alt="..."></a>
            </div>
        </div>
    </div>
    <div class="cl"></div>



    <script>
        $(function () {
            jQuery("#slider-3 .slider").slide({
                mainCell: ".bd ul",
                titCell: ".hd li",
                trigger: "click",
                effect: "leftLoop",
                autoPlay: true,
                delayTime: 700,
                interTime: 3000,
                pnLoop: false,
                titOnClassName: "active"
            });
        });
    </script>

@stop
