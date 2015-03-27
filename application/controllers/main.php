<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

    public function index(){

        if($this->is_post()){

            $file = $_FILES['upload'];

            $file_upload = $this->downloadfile($file);

            if($file_upload){
                $email = $this->input->post('email');
                $subject = "Спасибо вам за ваш заказ";
                $text = "Спасибо вам за ваш заказ";

                $this->sendmailer->addAttachment($file_upload);

                $this->sendmailer->setSenderLabel('PSDTOHTML4YOU');
                $this->sendmailer->setRecipient($email, "Заказчик");
                $this->sendmailer->send($subject, $text);
                unlink($file_upload);
            }



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