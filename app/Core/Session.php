<?php

namespace Palayop\Demomvc\Core;

class Session
{
    const AUTH_USER = 'auth_token';

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return $_SESSION[$key] ?? false;
    }

    public static function remove($key)
    {
        unset($_SESSION[$key]);
    }
}