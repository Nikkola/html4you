<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

    public function index(){

        if($this->is_post()){

            ini_set('post_max_size', '200M');
            ini_set('upload_max_filesize', '200M');
            set_time_limit(600);

            $file = $_FILES['upload'];

            $file_upload = $this->downloadfile($file);

            if($file_upload){

                // Отправка письма пользователю
                $email = $this->input->post('email');
                $subject = "Спасибо вам за ваш заказ";
                $text = "Спасибо вам за ваш заказ";
                $this->sendmailer->setSenderLabel('PSDTOHTML4YOU');
                $this->sendmailer->setRecipient($email, "Заказчик");
                $this->sendmailer->send($subject, $text);

                // Письмо администратору
                $subject = "Новый заказ на верстку проекта";
                $text = "Пришел заказ на верстку с почты <a href='mailto:{$email}'>{$email}</a>";
                $this->sendmailer->setSenderLabel('PSDTOHTML4YOU');
                $this->sendmailer->setRecipient($this->config->item('email_user'), "Администратор");
                $this->sendmailer->addAttachment($file_upload);
                $this->sendmailer->send($subject, $text);
                unlink($file_upload);

            }

            redirect('/');

        } else {
            parent::render('index');
        }

    }


    protected function downloadfile($file){

        if(!$file['error']){

            $filedist = $_SERVER['DOCUMENT_ROOT'].'/uploadfiles/'.$file['name'];
            if(move_uploaded_file($file['tmp_name'], $filedist)){
                return $filedist;
            } else {
                return false;
            }

        }

        return false;


    }

}