<?php

namespace Palayop\Demomvc\Middlewares;

abstract class Middleware
{
    abstract public function run($context, $method);
}