<?php


namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 解析详细收货地址,获取地区代码
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setFullAddress($value)
 */
class ParseArea extends OmRequest
{
    protected $paramKeys = [
        'fullAddress',
    ];
}