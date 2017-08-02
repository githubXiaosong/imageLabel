<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26
 * Time: 16:40
 */

define('SUCCEED', 0);
define('PARAMS_ERROR', 1);
define('SERIOUS_ERROR_DB', 300);
define('IMAGE_HANDLER_ERROR',2);

define('IMAGE_LIST_PARE_LIMIT', 1);

//这里定义的是一个序列化之后的数组 使用的时候需要反序列化
define('NUMBER_PER_GROUPS', serialize(array(5,10)));
define('MIN_MONEY', serialize(array(10,15,20)));




