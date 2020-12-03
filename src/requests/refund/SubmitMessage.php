<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 提交退款单留言
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 * @method $this setRefundMessage($value)
 * @method $this setRefundMessagePics($value)
 */
class SubmitMessage extends OmRequest
{
    protected $paramKeys = [
        'orderId',
        'refundMessage',
        'refundMessagePics',
    ];
}