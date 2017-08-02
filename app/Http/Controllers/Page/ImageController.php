<?php

namespace App\Http\Controllers\Page;


use App\Group;
use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class ImageController extends Controller
{

    /**
     * 以后凡是list数据和分页的 都把移动端和web端分开 laravel的list接口
     *
     * 但是后期还是要重新权衡接口的统一性和编码的方便程度！！！
     *
     *
     * 在page上就不返回错误信息了  不用Validate了 因为如果传错数据 页面刷不出来的 对于用户很不友好
     *
     */
    function groups()
    {
        //下面的代码要和laravel的page方法做对接
//        $groups= DB::table('groups')
//            ->where(['status' => 0])
//            ->limit($l['limit'])
//            ->skip($l['skip'])
//            ->get();

        $groups_pre = (new Group())->where(['status' => 0]);
        $categories = DB::table('categories')->get(['id', 'title']);

        //这个rq如果参数是0的话就忽略了
        if (rq('category_id')) {
            $groups_pre = $groups_pre->where('category_id', rq('category_id'));
        }
        if (rq('min_money')) {
            $groups_pre = $groups_pre->where('money', '>=', rq('min_money'));
        }
        if (rq('num')) {
            $groups_pre = $groups_pre->where('num', rq('num'));
        }

        $groups = $groups_pre->paginate(IMAGE_LIST_PARE_LIMIT);

        //这边我们要判断的是0也是有效的
        if (null !== rq('category_id')) {
            $groups->appends(['category_id' => rq('category_id')]);

        }
        if (null !== rq('min_money')) {
            $groups->appends(['min_money' => rq('min_money')]);
        }
        if (null !== rq('num')) {
            $groups->appends(['num' => rq('num')]);
        }

        return view('page.image.groups')->with([
            'groups' => $groups,
            'select_num' => unserialize(NUMBER_PER_GROUPS),
            'select_category' => $categories,
            'select_minMoney' => unserialize(MIN_MONEY)
        ]);
    }


    function lists()
    {
        if (!(rq('group_id') && rq('money') && rq('category_title')))
            return redirect('/');

        $images = DB::table('images')->where(['status' => 0, 'group_id' => rq('group_id')])->get(['id', 'url', 'status', 'order_id']);

        //我省的从数据库里查了 直接从get参数来了

        return view('page.image.list')->with(['images' => $images]);
    }


}
