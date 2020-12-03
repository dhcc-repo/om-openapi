<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 关闭退款单
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 */
class CloseRefund extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}