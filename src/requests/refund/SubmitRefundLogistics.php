<?php

namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 创建退款单
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setOrderId($value)
 * @method $this setLogisticsNo($value)
 * @method $this setLogisticsCompanyName($value)
 * @method $this setLogisticsCompanyCode($value)
 */
class SubmitRefundLogistics extends OmRequest
{
    protected $paramKeys = [
        'orderId',
        'logisticsNo',
        'logisticsCompanyName',
        'logisticsCompanyCode',
    ];
}