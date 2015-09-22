<?php

namespace Millennium\Cache\Drivers;

use Millennium\Cache\Interfaces\CacheDriver;

class XCacheDriver implements CacheDriver
{

    public function __construct()
    {
        if (!function_exists('xcache_isset')) {
            throw new \Millennium\Cache\Exceptions\DriverNotFoundException('XCache not installed on your system');
        }
    }

    public function fetch($key)
    {
        if (xcache_isset($key)) {
            return xcache_get($key);
        }
        return null;
    }

    public function remove($key)
    {
        if (xcache_isset($key)) {
            xcache_unset($key);
        }
    }

    public function store($key, $data, $expire = 0)
    {
        return xcache_set($key, $data, $expire);
    }

}
