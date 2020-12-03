<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 删除订单,将订单标记为软删除状态
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderId($value)
 */
class DelOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}