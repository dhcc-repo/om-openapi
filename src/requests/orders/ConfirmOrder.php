<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 确认收货
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderId($value)
 */
class ConfirmOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}