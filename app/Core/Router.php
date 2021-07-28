<?php

namespace Palayop\Demomvc\Core;

use Exception;

class Router
{
    private $currentController = "HomeController";
    private $currentMethod = 'index';

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->resolve();
    }

    /** @noinspection PhpUnused */
    public static function redirectTo($path)
    {
        header('Location: ' . URL_ROOT . $path);
    }

    /**
     * @throws Exception
     */
    private function resolve(): void
    {
        $url = $this->getURL();

        if (file_exists('../app/Controllers/' . ucwords($url[0]) . 'Controller.php')) {
            $this->currentController = ucwords($url[0]) . 'Controller';
            unset($url[0]);
        } else {
            if (!empty($url)) {
                throw new Exception("404");
            }
        }

        $classController = '\\Palayop\Demomvc\\Controllers\\' . $this->currentController;

        $this->currentController = new $classController();

        if (isset($url[1])) {
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            } else {
                throw new Exception("404");
            }
        }

        $params = self::getRequest();

        foreach ($this->currentController->getMiddlewares() as $middleware) {
            $middleware->run($this->currentController, $this->currentMethod);
        }

        call_user_func([$this->currentController, $this->currentMethod], $params);
    }

    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getRequest(): array
    {
        $data = [];
        $method = self::getMethod();
        if ($method === 'get') {
            foreach ($_GET as $key => $value) {
                if ($key == 'url') continue;
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($method === 'post') {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $data;
    }

    private function getURL(): ?array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return null;
    }
}