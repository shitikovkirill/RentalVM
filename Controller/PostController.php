<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.09.16
 * Time: 14:02
 */

namespace Controller;


use Core\BaseController;
use Model\CommentModel;
use Model\PostModel;
use Plasticbrain\FlashMessages\FlashMessages;

class PostController extends BaseController
{
    public function saveAction(array $parameters)
    {
        if (isset($_POST['submit'])) {

            $name  = filter_input(
                INPUT_POST,
                'name',
                FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>'/^[a-zA-ZА-Яа-яЁё\s]+$/'))
            );
            $text = filter_input(
                INPUT_POST,
                'text',
                FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>"/.{10,}/"))
            );

            if (!session_id()) @session_start();
            $msg = new FlashMessages();

            if (empty($name)) {
                $msg->error('Имя должно содержать только a-zA-Z');
            }
            if (empty($text)) {
                $msg->error('Текст должен быть больше 10 символов');
            }

            if ($msg->hasErrors()) {
                $url = '/';
                header('Location: '.$url);
            } else {
                $postModel = new PostModel($this->getDbConection());
                $postModel ->save($name, $text);
                $msg->info('Запись добавлена');
            }
        }
        $url = '/';
        header('Location: '.$url);
        return [];
    }

    public function showAction(array $parameters)
    {
        $postModel = new PostModel($this->getDbConection());
        $post = $postModel -> get($parameters[0]);

        $commentModel = new CommentModel($this->getDbConection());
        $comments = $commentModel ->getByPost($parameters[0]);

        return [
            'post' => $post,
            'comments' =>$comments,
        ];
    }
}