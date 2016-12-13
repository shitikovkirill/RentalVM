<?php

namespace Core;

use Core\Exception\UrlNotFoundException;

class Router
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    private function getController()
    {
        $path = $this->request->getPath();
        $controller_name = ucfirst($path['controller']);

        return '\\Controller\\'.$controller_name.'Controller';
    }

    private function getAction()
    {
        $path = $this->request->getPath();
        $action_name = $path['action'];
        return $action_name.'Action';
    }

    public function runController($container)
    {
        $path = $this->request->getPath();
        $parameters = $path['parameters'];

        $controller = $this->getController();
        $action     = $this->getAction();

        if (!class_exists($controller)) {
            throw new UrlNotFoundException('Такого контроллера нет');
        }
        $controller_obj = new $controller($container);

        if (!method_exists($controller, $action)) {
            throw new UrlNotFoundException('Такого action нет');
        }

        $data = $controller_obj -> $action($parameters);
        return $data;
    }
}