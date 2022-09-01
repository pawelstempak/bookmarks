<?php
/* core/Controller.php */

namespace app\core;

class Controller 
{
    public string $layout = 'main';
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function redirect($route)
    {
        header('Location: '.$route);
    }

    public function render($view, $menu = [], $params = [])
    {
        return Application::$core->router->renderView($view, $menu, $params);
    }
}