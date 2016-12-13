<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.09.16
 * Time: 9:42
 */

namespace Controller;


use Core\BaseController;
use Model\FeedbackModel;
use Model\PostModel;

class IndexController extends BaseController
{
    public function indexAction(array $parameters)
    {
        $postModel = new PostModel($this->getDbConection());
        $posts = $postModel -> getAll();

        $posts_with_comments = $postModel->getPostsOrderByCountComment();

        return [
            'posts'=>$posts,
            'posts_with_comments'=>$posts_with_comments,
        ];
    }
}