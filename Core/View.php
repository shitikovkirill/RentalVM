<?php
namespace Core;

class View{
    
    private $request;
    private $template;
    
    public function __construct(Request $request, $template = null)
    {
         $this->request = $request;
        $this->template = $template;
    }

    public function renderTemplate($vars = []){

        $path = $this -> request ->getPath();

        $view_path_dir = __DIR__.'/../View/';
        $view_path = $path['controller'].'/'.$path['action'];

        if(empty($this->template)){
            foreach ($vars as $key => $value)
            {
                $$key = $value;
            }
            return include $view_path_dir.$view_path .'.phtml';
        } else {
           echo $this->template ->render($view_path.'.twig', $vars);
        }
    }
}