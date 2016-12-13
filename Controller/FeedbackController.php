<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.09.16
 * Time: 14:02
 */

namespace Controller;


use Core\BaseController;
use Core\Exception\ParameterNotFoundException;
use Model\FeedbackModel;
use Plasticbrain\FlashMessages\FlashMessages;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class FeedbackController extends BaseController
{
    public function saveAction(array $parameters){
        if (isset($_POST['submit'])) {

            $email = filter_input(INPUT_POST,'email',  FILTER_VALIDATE_EMAIL);
            $name  = filter_input(INPUT_POST,'name',  FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>'/^[a-zA-ZА-Яа-яЁё\s]+$/'))
                );
            $comment = filter_input(INPUT_POST,'comment', FILTER_VALIDATE_REGEXP,
                array("options"=>array("regexp"=>"/.{10,}/"))
            );

            if (!session_id()) @session_start();
            $msg = new FlashMessages();

            if(empty($email)){
                $msg->error('Неправильно указаный Email');
            }
            if(empty($name)){
                $msg->error('Имя должно содержать только a-zA-Z');
            }
            if(empty($comment)){
                $msg->error('Текст должен быть больше 10 символов');
            }

            if ($msg->hasErrors()) {
                $url = '/';
                header('Location: '.$url);
            } else {
                $image_url = null;
                if(isset($_FILES['fileToUpload']['size']) &&
                    !empty($_FILES['fileToUpload']['size'])){
                    $image_url = $this->uploadImage();
                }
                $feedbackModel = new FeedbackModel($this->getEntityManager());
                $feedbackModel ->saveFeedback($email, $name, $comment, $image_url);
                $msg->info('Отзыв добавлен');
            }
        }
        $url = '/';
        header('Location: '.$url);
        return [];
    }

    public function editAction(array $parameters){

        if(!$this->isLogin()){
            $url = '/';
            header('Location: '.$url);
        }

        if(!isset($parameters[0])){
            throw new ParameterNotFoundException('Нужно передать id');
        }

        if(!is_int(intval($parameters[0]))){
            throw new InvalidArgumentException('id должен быть числом');
        }

        $feedback_model = new FeedbackModel($this->getEntityManager());
        $feedback = $feedback_model -> getFeedback($parameters[0]);

        $data=[];
        if($feedback){
            $data ['feedback'] = $feedback;
        } else {
            throw new \InvalidArgumentException('Продукта с таким id нет');
        }

        return $data;
    }

    public function dellAction(array $parameters){
        if(!$this->isLogin()){
            $url = '/';
            header('Location: '.$url);
        }

        if(!isset($parameters[0])){
            throw new ParameterNotFoundException('Нужно передать id');
        }

        if(!is_int(intval($parameters[0]))){
            throw new InvalidArgumentException('id должен быть числом');
        }

        $feedback_model = new FeedbackModel($this->getEntityManager());
        $dell_feedback = $feedback_model -> dellFeedback($parameters[0]);

        if($dell_feedback){
            $url = '/admin';
            header('Location: '.$url);
        } else {
            throw new \InvalidArgumentException('Продукта с таким id нет');
        }

        $url = '/admin';
        header('Location: '.$url);
    }

    public function save_after_editAction(){

        if(!$this->isLogin()){
            $url = '/';
            header('Location: '.$url);
        }

        $id = filter_input(INPUT_POST,'id',  FILTER_VALIDATE_INT);
        $email = filter_input(INPUT_POST,'email',  FILTER_VALIDATE_EMAIL);
        $name  = filter_input(INPUT_POST,'name',  FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>'/^[a-zA-ZА-Яа-яЁё\s]+$/'))
        );
        $comment = filter_input(INPUT_POST,'comment', FILTER_VALIDATE_REGEXP,
            array("options"=>array("regexp"=>"/.{10,}/"))
        );

        $accept = filter_input(INPUT_POST,'accept', FILTER_VALIDATE_BOOLEAN);

        if (!session_id()) @session_start();
        $msg = new FlashMessages();

        if(empty($email)){
            $msg->error('Неправильно указаный Email');
        }
        if(empty($name)){
            $msg->error('Имя должно содержать только a-zA-Z');
        }
        if(empty($comment)){
            $msg->error('Текст должен быть больше 10 символов');
        }

        if ($msg->hasErrors()) {
        } else {
            $image_url = null;
            if(isset($_FILES['fileToUpload']['size']) &&
                !empty($_FILES['fileToUpload']['size'])){
                $image_url = $this->uploadImage();
            }

            $feedback_model = new FeedbackModel($this->getEntityManager());
            $feedback_model->saveByAdminFeedback($id, $email, $name, $comment, $accept, $image_url);
            $msg->info('Отзыв изменен');
        }
        $url = '/feedback/edit/'.$id;
        header('Location: '.$url);
    }

    private  function  uploadImage(){
        if (!session_id()) @session_start();
        $msg = new FlashMessages();

        $target_dir = BASE_DIR . IMAGE_URL;
        $file_name = basename($_FILES["fileToUpload"]["name"]);
        $target_file = $target_dir . $file_name;
        $uploadOk = 1;

        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                //$msg->info("File is an image - " . $check["mime"] . ".") ;
                $uploadOk = 1;
            } else {
                $msg->warning("File is not an image.");
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if (file_exists($target_file)) {
            $msg->info("File already exists.");
            $uploadOk = 0;
            return $file_name;
        }
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            $msg->warning("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            $msg->warning("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg->warning("Sorry, your file was not uploaded.");
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $msg->success("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
                return $file_name;
            } else {
                $msg->warning("Sorry, there was an error uploading your file.");
            }
        }
        return false;
    }
}