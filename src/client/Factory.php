<?php

namespace Dhcc\OmOpenapi\client;

use Dhcc\OmOpenapi\utility\Str;

/**
 * Class Factory.
 *
 * @method static OmClient omClient(array $config)
 * @method static GuzzleOmClient guzzleOmClient(array $config)
 */
class Factory
{

    /**
     * @param       $name
     * @param array $config
     * @return OmClient
     */
    public static function make($name, array $config = []): OmClient
    {
        $namespace    = '\\Dhcc\\OmOpenapi\\client\\' . Str::studly($name);
        $clientId     = $config['client_id'] ?? null;
        $clientSecret = $config['client_secret'] ?? null;
        /** @var  $instance  OmClient */
        $instance = new $namespace($clientId, $clientSecret);
        return $instance;
    }

    /**
     * Dynamically pass methods to the application.
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}