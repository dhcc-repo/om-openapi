<?php


namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取退款单详情
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 */
class GetRefund extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}