<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.09.16
 * Time: 9:50
 */

namespace Core;


class BaseController
{
    private $container;

    private $admin_logged;

    public function __construct($container)
    {
        if (!session_id()) @session_start();
        isset($_SESSION['admin']) ? $this->admin_logged = $_SESSION['admin'] : $this->admin_logged = 0;
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }



    public function getDbConection(){

        if (!empty($this->container['db'])) {
            return $this->container['db'];
        }
        return null;
    }

}