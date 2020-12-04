# OM-OPENAPI SDK for PHP7 

## 项目简介
适用于开发OM项目的PHP-SDK

## 使用说明

```bash
composer require dhcc/om-openapi
```

## 快速开始

### 快速初始化客户端
除了手动new客户端，也可以使用简易工厂类
```php
use \Dhcc\OmOpenapi\client\Factory;
$omClient = Factory::guzzleOmClient([]);

```

### 初始化请求类

以删除订单为例
```php
use \Dhcc\OmOpenapi\requests\refund\DelRefund;
$request = new DelRefund();
$request->setOrderId(1);
```

### 发送请求

```php
$response = $omClient->execute($request);
```