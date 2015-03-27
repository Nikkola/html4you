<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends MY_Controller {

    public function index(){

        if($this->is_post()){

            print_r($_FILES);
            exit;

            $email = $this->input->post('email');
            $subject = "Спасибо вам за ваш заказ";
            $text = "Спасибо вам за ваш заказ";

            $this->sendmailer->setSenderLabel('PSDTOHTML4YOU');
            $this->sendmailer->setRecipient($email, "Заказчик");
            $this->sendmailer->send($subject, $text);

        } else {
            parent::render('index');
        }

    }


    protected function downloadfile($file){



    }

}