<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 获取商品列表
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setGoodsId($value)
 * @method $this setSkuId($value)
 * @method $this setNums($value)
 * @method $this setUserId($value)
 * @method $this setBuyerPhone($value)
 * @method $this setAddress($value)
 * @method $this setAreaCode($value)
 * @method $this setPostcode($value)
 */
class PreviewOrder extends OmRequest
{
    protected $paramKeys = [
        'goodsId',
        'skuId',
        'nums',
        'userId',
        'buyerName',
        'buyerPhone',
        'address',
        'areaCode',
        'postcode',
    ];

}