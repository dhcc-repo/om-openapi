<?php

namespace Dhcc\OmOpenapi\requests\orders;

use Dhcc\OmOpenapi\requests\OmRequest;

/**
 * 创建订单
 * @package Dhcc\OmOpenapi\requests\orders
 * @method $this setGoodsId($value)
 * @method $this setSkuId($value)
 * @method $this setNums($value)
 * @method $this setPid($value)
 * @method $this setUserId($value)
 * @method $this setBuyerPhone($value)
 * @method $this setAddress($value)
 * @method $this setAreaCode($value)
 * @method $this setPostcode($value)
 * @method $this setShippingType($value)
 * @method $this setRemark($value)
 */
class CreateOrder extends OmRequest
{
    protected $paramKeys = [
        'goodsId',
        'skuId',
        'nums',
        'userId',
        'pid',
        'buyerName',
        'buyerPhone',
        'address',
        'areaCode',
        'postcode',
        'shippingType',
        'remark',
    ];
}