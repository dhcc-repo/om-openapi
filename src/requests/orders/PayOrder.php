<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 对已创建成功的订单发起协议扣款
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderId($value)
 */
class PayOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}