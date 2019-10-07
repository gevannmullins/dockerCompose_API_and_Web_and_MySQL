<?php

use MVC\Controller;

class ControllersDreamcity extends Controller
{


    public function index()
    {

        // Connect to database
        $model = $this->model('dreamcity');

        // Get all the users
        $data_list = $model->index();
        $returnData = [];
        foreach($data_list as $key=>$value){
            $returnData[$value['client_name']][] = [
                "account_id" => $value['account_id'],
                "account_name" => $value['account_name']
            ];
        }

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }

    public function save_info()
    {

        $auth_user = "dreamcity";
        $aut_pass = "Y[C[t8HWvG~drL)7";

        // get data
        $data = json_decode(file_get_contents("php://input"));
        $username = $data->username;
        $password = $data->password;
        if ($username!==$auth_user || $password!==$aut_pass){
            $this->response->sendStatus(400);
            $this->response->setContent("Error: username or password is incorrect");
            return null;
        }

        // Connect to database
        $model = $this->model('dreamcity');

        // Get all the users
        $data_list = $model->save_info($data);

        if (!$data_list) {
            // Send Response
            $this->response->sendStatus(400);
            $this->response->setContent("Error: bad request");
        }else{
            // Send Response
            $this->response->sendStatus(200);
            $this->response->setContent($data_list);

        }

    }





}