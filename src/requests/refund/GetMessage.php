<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 提交退款单留言
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 * @method $this setPage($value)
 * @method $this setPagesize($value)
 */
class GetMessage extends OmRequest
{
    protected $paramKeys = [
        'orderId',
        'page',
        'pagesize',
    ];
}