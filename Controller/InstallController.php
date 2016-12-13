<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 13.12.16
 * Time: 20:11
 */

namespace Controller;


use Core\BaseController;
use Plasticbrain\FlashMessages\FlashMessages;

class InstallController extends BaseController
{
    public function indexAction(array $parameters)
    {
        $this->getDbConection()->exec(
            'CREATE TABLE IF NOT EXISTS posts (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                author STRING,
                text STRING,
                created TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
            CREATE TABLE IF NOT EXISTS comments (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                author STRING,
                text STRING
            );
            CREATE TABLE IF NOT EXISTS posts_comments (
                post_id INTEGER,
                comment_id INTEGER UNIQUE,
                PRIMARY KEY (post_id, comment_id),
                FOREIGN KEY (post_id)    REFERENCES posts(id),
                FOREIGN KEY (comment_id) REFERENCES comments(id)
            );'
        );
        if (!session_id()) @session_start();
        $msg = new FlashMessages();
        $msg->info('Ваза данных создана');
        $url = '/';
        header('Location: '.$url);
        return [];
    }
}