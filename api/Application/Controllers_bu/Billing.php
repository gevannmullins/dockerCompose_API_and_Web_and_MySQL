<?php

use MVC\Controller;

class ControllersBilling extends Controller
{

    public function getInfo(){

        $data = json_decode(file_get_contents("php://input"));

        $user_id = $data->user_id;

        $billing_model = $this->model('billing');

        $save_test_result = $billing_model->save_test($user_id);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($save_test_result);


    }


}