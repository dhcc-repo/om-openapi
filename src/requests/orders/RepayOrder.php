<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 首次支付失败后,排除故障后重试支付,重复调用不会重复扣款
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderId($value)
 */
class RepayOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}