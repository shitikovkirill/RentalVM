<?php

namespace Core;

use Core\Exception\UrlNotFoundException;

class Request
{
    protected $get;
    protected $post;
    protected $request;
    protected $server;
    protected $cookies;
    protected $sessions;
    protected $path;

    
    public function __construct()
    {
        $this->get      = $_GET;
        $this->post     = $_POST;
        $this->request  = $_REQUEST;
        $this->server   = $_SERVER;
        $this->cookies = $_COOKIE;
        $this->path     = $this->parsUrl(@$_SERVER['REQUEST_URI']);
    }
    
    public function get($key)
    {
        return $this->request[$key];
    }

    private function parsUrl($url)
    {
        $path = [
            'controller' => 'index',
            'action'     => 'index',
            'parameters' => []
        ];
        if (isset($url)) {
            $data = explode('/', $url);

            $i = 0;
            foreach ($data as $value) {
                if (!empty($value)) {
                    switch ($i++){
                    case 0:
                        if (preg_match('/^[a-z_]*$/', $value)) {
                            $path['controller'] = $value;
                        } else {
                            throw new UrlNotFoundException(
                                'Часть Url: '.$value.' имеет недопустимое значение. <br>
                                Эта часть Url содержит имя контроллера и должно соответствовать /a-z/ '
                            );
                        }
                        break;
                    case 1:
                        if (preg_match('/^[a-z_]*$/', $value)) {
                            $path['action'] = $value;
                        } else {
                            throw new UrlNotFoundException(
                                'Часть Url: '.$value.' имеет недопустимое значение. <br>
                                Эта часть Url содержит имя action и должно содержать соответствовать /a-z/ '
                            );
                        }
                        break;
                    default:
                        $path['parameters'][] = $value;
                    }
                }
            }
        }
        return $path;
    }

    /**
     * @return array
     */
    public function getPath()
    {
        return $this->path;
    }
}