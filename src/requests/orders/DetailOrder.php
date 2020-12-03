<?php


namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * Class DetailOrder
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setOrderId($value)
 */
class DetailOrder extends OmRequest
{
    protected $paramKeys = [
        'orderId',
    ];
}