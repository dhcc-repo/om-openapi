<?php

namespace Dhcc\OmOpenapi\requests\goods;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取商品详情
 * @package Dhcc\OmOpenapi\requests\goods
 * @method $this setGoodsId($value)
 */
class DetailGoods extends OmRequest
{
    protected $paramKeys = [
        'goodsId',
    ];
}