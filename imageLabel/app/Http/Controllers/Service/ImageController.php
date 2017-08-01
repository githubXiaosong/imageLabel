<?php

namespace App\Http\Controllers\Service;

use App\Http\Requests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ImageController extends Controller
{


    /*
     * 一批图片应该是已经被分好组的 每组的大小应该是标准化的 暂定为10
     * 那么对于每个 '组' 来说 是不是应该有一个表来记录呢?????? 还有在客户端的计价应该是按图片？？ 还是按组？
     * 那么这个接口应该返回什么呢？ 一个数组？ 一个组的数组？？？？？
     * 一个组中只能包含一个订单的数据！
     *
     *
     *
     *
     *
     * 对于这个接口的策略：
     *  1以后再说什么紧急不紧急  算法上在进行调整
     *  2先直接对groups做分页查询
     *  3或者说以后的紧急程度 和其他可以筛选出来的属性 直接在group就体现来  order和groups的交接工作我们在后端完成
     *
     *
     *
     *
     * 传page过来
     */
    public function getImageGroups()
    {
        $validator = Validator::make(
            rq(),
            [
                'page' => 'integer',

            ],
            [

            ]
        );
        if ($validator->fails())
            return err(1, $validator->messages());


        $l = get_limit_and_skip(IMAGE_LIST_PARE_LIMIT);
//        orderBy
        $groups = DB::table('groups')
            ->where(['status' => 0])
            ->limit($l['limit'])
            ->skip($l['skip'])
            ->get();
        return suc($groups);
    }


    public function addWork()
    {

        $validator = Validator::make(
            rq(),
            [
                'group_id' => 'required|integer|exists:groups,id'

            ],
            [

            ]
        );
        if ($validator->fails())
            return err(1, $validator->messages());

        $group = DB::table('groups')->find(rq('group_id'));
        //不同或者根本没有
        if ($group->user_id != null)
            return err(IMAGE_HANDLER_ERROR);

        $user_id = session('user')->id;
        $ret = DB::table('groups')->where('id', rq('group_id'))->update(['user_id' => $user_id, 'status' => 10]);

        if (!$ret)
            return err(SERIOUS_ERROR_DB);
        return suc();
    }

    public function removeWork()
    {
        $validator = Validator::make(
            rq(),
            [
                'group_id' => 'required|integer|exists:groups,id'

            ],
            [

            ]
        );
        if ($validator->fails())
            return err(1, $validator->messages());

        $group = DB::table('groups')->find(rq('group_id'));
        $user_id = session('user')->id;
        //不同或者根本没有
        if ($group->user_id != $user_id)
            return err(IMAGE_HANDLER_ERROR);

        $ret = DB::table('groups')->where('id', rq('group_id'))->update(['user_id' => null, 'status' => 0]);

        if (!$ret)
            return err(SERIOUS_ERROR_DB);
        return suc();
    }


}

