<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 删除退款单
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 */
class DelRefund extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}