<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.09.16
 * Time: 7:53
 */

namespace Core;

class Application
{
    private $container;

    public function __construct ($container)
    {
        $this -> container = $container;
    }

    public function run()
    {
        $request    = new Request();
        $router     = new Router($request);
        $data = $router     -> runController($this->container);

        if (isset($this -> container['template'])) {
            $template = $this -> container['template'];
        } else {
            $template = null;
        }
        $view = new View($request, $this -> container['template']);

        $view -> renderTemplate($data);
    }
}