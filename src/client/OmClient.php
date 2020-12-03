<?php

namespace Dhcc\OmOpenapi\client;

use Dhcc\OmOpenapi\utility\Str;

class OmClient
{
    protected $appId;
    protected $appSecret;
    protected $httpGatewayUri        = "http://om-openapi.dhcc.wang";
    protected $httpsGatewayUri       = "https://om-openapi.dhcc.wang";
    protected $httpHostnameOverride  = false;
    protected $httpsHostnameOverride = false;
    protected $forceHttps            = false;
    protected $format                = "json";
    protected $connectTimeout;
    protected $readTimeout;
    protected $apiVersion            = "v1";
    protected $userAgent             = 'om-openapi-phpsdk';
    /** @var $httpClient \GuzzleHttp\Client PSR7 兼容的 HTTP client */
    protected $httpClient;

    /**
     * OmClient constructor.
     * @param $appId
     * @param $appSecret
     * @param $httpClient
     */
    protected function __construct($appId, $appSecret, $httpClient)
    {
        $this->appId      = $appId;
        $this->appSecret  = $appSecret;
        $this->httpClient = $httpClient;
        // 执行初始化事件
        $this->onInitialize();
    }

    protected function __destruct()
    {
    }

    protected function onInitialize()
    {
        if (!$this->appId || !$this->appSecret) {
            throw new \InvalidArgumentException('APP KEY和密钥不能为空');
        }
    }

    /**
     * @param      $uri
     * @param null $secure
     * @return $this
     */
    protected function setGatewayUri($uri, $secure = null)
    {
        if ($secure === null) {
            $uri    = strtolower($uri);
            $secure = Str::startsWith($uri, 'https') ?: false;
        }
        if ($secure == false) {
            $gateWay = 'http';
        } elseif ($secure == true) {
            $gateWay = 'https';
        }
        $hashTag = strstr($uri, '#');
        if ($hashTag !== false) {
            $this->{$gateWay . 'HostnameOverride'} = str_replace('#', '', $hashTag);
            $uri                                   = str_replace($hashTag, '', $uri);
        }
        $this->{$gateWay . 'GatewayUri'} = $uri;

        return $this;
    }

    protected function getappId()
    {

        return $this->appId;
    }

    /**
     * 参数签名
     * @param $params
     * @return string
     */
    protected function signPara($params)
    {
        unset($params['sign']);
        //去除空参数
        $signData = [];
        ksort($params);
        foreach ($params as $key => $value) {
            if ($value !== '') {
                $signData[$key] = $value;
            }
        }
        ksort($signData);//排序
        return md5(http_build_query($signData) . $this->appSecret);
    }

    /**
     * @param array $requests
     *
     * @return array
     */
    protected function performRequests(array $requests = [], $hangOnError = false)
    {
        $publicParas            = [];
        $publicParas["app_id"]  = $this->appId;
        $publicParas["version"] = $this->apiVersion;
        foreach ($requests as $key => $request) {
            /**
             * @var $request  \Dhcc\OmOpenapi\requests\OmRequest
             */
            $publicParas["api_name"] = $request->getApiName();
            $publicParas["time"]     = time();
            $request->extraParas     = array_merge((array)$request->extraParas, $publicParas);
            //签名
            $request->setSign($this->signPara($request->getRequestParas()));
            $gwUrl            = $this->httpGatewayUri;
            $hostNameOverRide = $this->httpHostnameOverride;
            if ($request->requireHttps || $this->forceHttps) {
                $gwUrl            = $this->httpsGatewayUri;
                $hostNameOverRide = $this->httpsHostnameOverride;
            }
            $psr7Request = (new \GuzzleHttp\Psr7\Request($request->requestMethod, $gwUrl))
                ->withHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8')
                ->withHeader('user-agent', $this->userAgent)
                ->withBody(\GuzzleHttp\Psr7\stream_for(http_build_query($request->getRequestParas())));

            if ($hostNameOverRide) {
                $psr7Request = $psr7Request->withHeader('host', $hostNameOverRide);
            }
            $requests[$key] = $psr7Request;
        }
        $responses = $this->sendRequests($requests);
        $results   = [];
        foreach ($responses as $key => $response) {
            $result = null;
            /**
             * @var  $response \GuzzleHttp\Psr7\Response
             */
            if ("json" === $this->format) {
                $decodedResponse = json_decode((string)$response->getBody(), true);
                if (null !== $decodedResponse) {
                    $result = current($decodedResponse);
                } else {
                    throw new \Exception('Invalid Json Response');
                }
            } elseif ("xml" === $this->format) {
                $decodedResponse = @simplexml_load_string((string)$response->getBody());
                if (false !== $decodedResponse) {
                    $result = json_decode(json_encode($decodedResponse), true);//把里面的Object对象转乘数组
                } else {
                    throw new \Exception('Invalid XML Response');
                }
            }
            if ($hangOnError && !empty($result['code'])) {
                throw new \Exception('请求的时候发生了错误: ' . json_encode($result), $result['code']);
            }
            $results[$key] = $result;
        }
        return $results;
    }

    /**
     * 请求方法为PSR7兼容的http客户端设计 ，如果客户端本身是PSR7兼容的,且有send($psr7Request)方法，无需覆盖此方法，
     * 直接改变 $this->httpClient 指向即可,抛出异常的类型，可能随着实际指向的http客户端的实现而变化
     * @return mixed|\Psr\Http\Message\ResponseInterface
     *
     * @throws \GuzzleHttp\Exception\GuzzleException |\RuntimeException |\Exception
     */
    protected function sendRequests($requests)
    {
        $responses = [];
        foreach ($requests as $key => $psr7Request) {
            $responses[$key] = $this->httpClient->send($psr7Request);
        }

        return $responses;
    }

    /**
     * @param      $requests
     * @param null $session
     * @return array|mixed
     * @throws \Exception
     */
    protected function execute($requests)
    {
        $returnFirst = false;
        if (!is_array($requests)) {
            $returnFirst = true;
            $requests    = [$requests];
        }
        $responses = $this->performRequests($requests);
        if ($returnFirst) {
            return current($responses);
        }
        return $responses;
    }
}
