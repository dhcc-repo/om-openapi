<?php

namespace Dhcc\OmOpenapi\requests;

use Dhcc\OmOpenapi\utility\Str;

/**
 * Class OmRequest
 * @package Dhcc\OmOpenapi\requests
 */
abstract class OmRequest
{
    /** @var bool 是否必须使用https借口 */
    public $requireHttps = false;
    /** @var array 应用参数 */
    protected $paramKeys = [];
    /** @var array 默认参数值 */
    protected $defaultParamValues = [];
    /** @var array 自动使用逗号隔开的字段 */
    protected $commaSeparatedParams = [];
    /**
     * @var array
     */
    protected $apiParas = [];
    /** @var string 自定义API名字 */
    protected $apiName;
    /**
     * @var string
     */
    public $requestMethod = 'POST';
    /**
     * @var array
     */
    public $extraParas = [];
    /**
     * @var
     */
    public $encryptedFields;

    /**
     * OmRequest constructor.
     */
    public function __construct()
    {
        if (!$this->apiName) {
            $class          = get_called_class();
            $namespaceArray = explode('\\', $class);
            $class          = end($namespaceArray);
            $lastNamespace  = prev($namespaceArray);
            $class          = explode('_', Str::snake($class, '_'));
            $class[]        = array_shift($class);//把动作名词放尾部
            $this->apiName  = ($lastNamespace ? $lastNamespace . '.' : '') . implode('.', $class);
        }
        if (!empty($this->defaultParamValues)) {
            foreach ($this->defaultParamValues as $para => $value) {
                $this->apiParas[Str::snake($para)] = (string)$value;
            }
        }
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (Str::startsWith($name, 'set') || Str::startsWith($name, 'get')) {
            $clearName    = Str::camel(substr($name, 3));
            $actionPrefix = substr($name, 0, 3);
            if (in_array($clearName, $this->paramKeys)) {
                return call_user_func_array([$this, '__' . $actionPrefix], array_merge([$clearName], $arguments));
            }
        }
        throw new \BadMethodCallException('不存在的方法调用: ' . $name);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     * @throws \Exception
     */
    public function __set($name, $value)
    {
        if (in_array($name, $this->commaSeparatedParams)) {
            return $this->setCommaSeparatedParam(Str::snake($name), $value);
        } elseif (in_array($name, $this->paramKeys)) {
            $this->apiParas[Str::snake($name)] = (string)$value;
            return $this;
        }
        throw new \Exception('指定的属性不可设置: ' . $name);
    }

    /**
     * @param $name
     * @return array|mixed|null
     * @throws \Exception
     */
    public function __get($name)
    {
        if (in_array($name, $this->commaSeparatedParams)) {
            return $this->getCommaSeparatedParam(Str::snake($name));
        } elseif (in_array($name, $this->paramKeys)) {
            return $this->apiParas[Str::snake($name)] ?? null;
        }
        throw new \Exception('指定属性不存在: ' . $name);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return json_encode([
            'request_para' => $this->getRequestParas(),
            'self'         => $this,
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setCommaSeparatedParam($name, $value)
    {
        if (is_array($value)) {
            $value = implode(',', $value);
        }
        $this->apiParas[$name] = $value;
        return $this;
    }

    /**
     * @param $name
     * @return array
     */
    public function getCommaSeparatedParam($name)
    {
        $values = $this->apiParas[$name] ?? '';
        return array_filter(explode(',', $values));
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function addCommaSeparatedParamsField($name, $value)
    {
        if (is_string($value)) {
            $value = array_filter(explode(',', $value));
        }
        $originalFields = $this->getCommaSeparatedParam($name);
        return $this->setCommaSeparatedParam($name, array_merge((array)$originalFields, $value));
    }

    /**
     * @return string
     */
    public function getApiName()
    {
        return $this->apiName;
    }

    /**
     * @param $name
     * @return $this
     */
    public function setApiName($name)
    {
        $this->apiName = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getApiParas()
    {
        return $this->apiParas;
    }

    /**
     * @param $sign
     * @return $this
     */
    public function setSign($sign)
    {
        $this->extraParas["sign"] = $sign;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequestParas()
    {
        return array_merge((array)$this->extraParas, (array)$this->apiParas);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkPayload()
    {
        if (!($this->extraParas["sign"] ?? true)) {
            throw new \Exception('Sign is not set');
        }
        return true;
    }
}
