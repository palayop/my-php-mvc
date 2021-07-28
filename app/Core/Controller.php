<?php /** @noinspection PhpUnused */

namespace Palayop\Demomvc\Core;

class Controller
{
    private $middlewares = [];
    private $layout = null;
    private $scripts = [];
    private $styles = [];
    public $content;

    public $data = [];

    public function styles(): string
    {
        $result = '';
        foreach ($this->styles as $style)
            $result .= "<link href=\"$style\" rel=\"stylesheet\" type=\"text/css\"/>\n";
        return $result;
    }

    public function scripts(): string
    {
        $result = '';
        foreach ($this->scripts as $script)
            $result .= "<script src=\"$script\"></script>\n";
        return $result;
    }

    public function setMiddleware($middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function setLayout($name)
    {
        $this->layout = $name;
    }

    public function json($data)
    {
        header_remove("X-XSS-Protection");
        header("Content-type: application/json; charset=utf-8");
        echo json_encode($data);
    }

    /** @noinspection PhpIncludeInspection */
    public function view($view)
    {
        $path = str_replace('Controller', '', str_replace('Palayop\\Demomvc\\Controllers\\', '', get_called_class()));
        if (file_exists('../app/Views/' . $path . '/' . $view . '.php')) {
            if (!empty($this->layout)) {
                ob_start();
                require_once APP_ROOT . '/Views/' . $path . '/' . $view . '.php';
                $this->content = ob_get_clean();
                require_once APP_ROOT . '/Views/Shared/' . $this->layout . '.php';
            } else {
                require_once APP_ROOT . '/Views/' . $path . '/' . $view . '.php';
            }
        } else {
            die("View does not exists.");
        }
    }
}