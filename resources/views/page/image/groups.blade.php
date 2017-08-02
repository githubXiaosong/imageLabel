@extends('page.template')

@section('title')
    image-groups
@stop

@section('js/css')

@stop

@section('content')

    <div class="container forty-padding-top">

        <div class="cl"></div>

        <form class=" cl " action="">
            <div class="col-md-4 col-md-offset-7">
                <div class="col-md-4">

                   <span class="select-box">
                          <select class="select" size="1" name="num">
                              <option value="0" selected>无限制</option>
                              @foreach($select_num as $item)
                                  <option value="{{$item}}" {{ rq('num')==$item?'selected':'' }}>{{ $item }}</option>
                              @endforeach

                          </select>
                        </span>
                </div>


                <div class="col-md-4">

                   <span class="select-box">
                          <select class="select" size="1" name="category_id">
                              <option value="0">无限制</option>
                              @foreach($select_category as $item)
                                  <option value="{{$item->id}}" {{ rq('category_id')==$item->id?'selected':'' }}>{{ $item->title }}</option>
                              @endforeach
                          </select>
                        </span>
                </div>
                <div class="col-md-4">

                   <span class="select-box">
                                <select class="select" size="1" name="min_money">
                                    <option value="0" selected>无限制</option>
                                    @foreach($select_minMoney as $item)
                                        <option value="{{$item}}"  {{ rq('min_money')==$item?'selected':'' }} >{{ $item }}</option>
                                    @endforeach

                                </select>
                        </span>
                </div>
            </div>

            <div class="col-md-1">
                <input class="btn btn-default" type="submit" value="筛选">
            </div>
        </form>


        <div class="col-md-10 col-md-offset-1 forty-padding-top cl">
            @if($groups[0] == null)
                <div class="Huialert Huialert-info"><i class="icon-remove"></i>暂无数据</div>
            @endif
            @foreach($groups as $group)
                <div class="album-item col-md-3">
                    <a href="/imageList?group_id={{ $group->id }}&money={{ $group->money }}&category_title={{ $group->category->title }}">
                        <div class="album-img">
                            <img src=" {{ $group->pic }}">
                        </div>
                        <div class="album-title">{{ $group->category->title }}
                            <span class="c-999">({{ $group->num }}张)</span>
                            <span class="f-r"><strong>￥{{ $group->money }}</strong></span>
                        </div>
                        <div class="album-bg">
                            <div class="album-bg-Fir"></div>
                            <div class="album-bg-Sec"></div>
                        </div>
                    </a>
                </div>

            @endforeach

        </div>

        <div class="cl"></div>

        <div class="text-c forty-padding-top">
            {{ $groups->links() }}
        </div>

    </div>

    <script>

    </script>
@stop
