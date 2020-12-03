<?php

namespace Dhcc\OmOpenapi\client;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class GuzzleOmClient extends OmClient
{

    protected function __construct($appId, $appSecret, Client $httpClient = null)
    {
        if (!$httpClient) {
            $httpClient = new Client(
                [
                    'verify'          => false,
                    'timeout'         => 50,
                    'connect_timeout' => 30,
                ]
            );
        }
        parent::__construct($appId, $appSecret, $httpClient);
    }

    /**
     * @param $requests
     *
     * @return array|mixed|ResponseInterface
     * @throws Throwable
     */
    public function sendRequests($requests)
    {
        foreach ($requests as $key => $request) {
            $requests[$key] = $this->httpClient->send($request);
        }
        return $requests;
    }
}
