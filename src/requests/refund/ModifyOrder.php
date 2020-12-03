<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 创建退款单
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 * @method $this setRefundType($value)
 * @method $this setRefundReason($value)
 * @method $this setRefundDesc($value)
 * @method $this setGoodsStatus($value)
 */
class ModifyOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
        'refundType',
        'refundReason',
        'refundDesc',
        'goodsStatus',
    ];
}