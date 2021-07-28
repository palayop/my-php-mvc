<?php

namespace Palayop\Demomvc\Middlewares;

use Exception;
use Palayop\Demomvc\Core\Session;

class AuthMiddleware extends Middleware
{
    private $exceptions;

    public function __construct($array = [])
    {
        if (empty($array))
            $array['exceptions'] = [];
        $this->exceptions = $array['exceptions'];
    }

    /**
     * @throws Exception
     */
    public function run($context, $method)
    {
        $userToken = Session::get(Session::AUTH_USER);
        if (!in_array($method, $this->exceptions)) {
            if (!isset($userToken) || empty($userToken)) {
                throw new Exception("401");
            }
        }
    }
}