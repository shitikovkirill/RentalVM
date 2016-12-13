<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 13.12.16
 * Time: 21:24
 */

namespace Controller;


use Core\BaseController;
use Model\CommentModel;
use Plasticbrain\FlashMessages\FlashMessages;

class CommentController extends BaseController
{
    public function addAction(array $parameters)
    {
        if (isset($_POST['submit'])) {
            $id  = filter_input(
                INPUT_POST,
                'id',
                FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>'/^[0-9]+$/'))
            );
            $name  = filter_input(
                INPUT_POST,
                'name',
                FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>'/^[a-zA-ZА-Яа-яЁё\s]+$/'))
            );
            $comment = filter_input(
                INPUT_POST,
                'comment',
                FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>"/.{10,}/"))
            );

            if (!session_id()) @session_start();
            $msg = new FlashMessages();

            if (empty($id)) {
                $msg->error('Неверный id поста');
            }
            if (empty($name)) {
                $msg->error('Имя должно содержать только a-zA-ZА-Яа-яЁё');
            }
            if (empty($comment)) {
                $msg->error('Текст должен быть больше 10 символов');
            }

            if ($msg->hasErrors()) {
                $url = '/';
                header('Location: '.$url);
            } else {
                $commentModel = new CommentModel($this->getDbConection());
                $commentModel ->save($name, $comment, $id);
                $msg->info('Комментарий добавлен');
            }
        }
        $url = '/post/show/'.$id;
        header('Location: '.$url);
        return [];
    }
}