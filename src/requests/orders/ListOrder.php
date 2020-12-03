<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取订单列表
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderStatus($value)
 * @method $this setPage($value)
 * @method $this setPagesize($value)
 * @method $this setUserId($value)
 */
class ListOrder extends OmRequest
{
    protected $paramKeys = [
        'orderStatus',
        'page',
        'pagesize',
        'userId',
    ];
}