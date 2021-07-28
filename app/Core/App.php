<?php

namespace Palayop\Demomvc\Core;

use Exception;

class App
{
    public function __construct()
    {
        try {
            new Router();
        } catch (Exception $e) {
            if ($e->getMessage() === '404') {
                require_once APP_ROOT . '/Views/Shared/error.php';
            }
            else if ($e->getMessage() === '401') {
                Router::redirectTo('/home/index');
            }
        }
    }
}