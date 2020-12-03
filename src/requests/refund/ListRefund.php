<?php


namespace Dhcc\OmOpenapi\requests\refund;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取售后列表
 * @package Dhcc\OmOpenapi\requests\refund
 * @method $this setUserId($value)
 * @method $this setPage($value)
 * @method $this setPagesize($value)
 */
class ListRefund extends OmRequest
{
    protected $paramKeys = [
        'userId',
        'page',
        'pagesize',
    ];
}