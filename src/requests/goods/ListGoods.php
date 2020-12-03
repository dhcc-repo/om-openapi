<?php

namespace Dhcc\OmOpenapi\requests\goods;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取商品列表
 * @package Dhcc\OmOpenapi\requests\goods
 * @method $this setGroupName($value)
 * @method $this setPagesize($value)
 * @method $this setGoodsCategoryId($value)
 * @method $this setIsHot($value)
 * @method $this setTitle($value)
 * @method $this setSort($value)
 */
class ListGoods extends OmRequest
{
    protected $paramKeys = [
        'page',
        'pagesize',
        'goodsCategoryId',
        'isHot',
        'title',
        'sort',
    ];
}