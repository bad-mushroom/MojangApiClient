<?php

namespace BadMushroom\MojangApiClient\Facades;

use Exception;
use Illuminate\Support\Facades\Facade;
use RuntimeException;

class Mojang extends Facade
{
    public static function __callStatic($method, $args)
    {
        try {
            $instance = static::resolveFacadeInstance(static::getClientFacadeAccessor($method));
        } catch (Exception $e) {
            throw new RuntimeException('Unknown Mojang API client request: ' . $method);
        }

        return $instance;
    }

    protected static function getClientFacadeAccessor($client)
    {
        return 'clients.mojang.' . $client;
    }
}
