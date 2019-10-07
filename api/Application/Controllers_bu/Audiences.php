<?php

use MVC\Controller;

class ControllersAudiences extends Controller
{


    public function index()
    {

        // Connect to database
        $model = $this->model('audiences');

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

    public function get_audiences()
    {

        // Connect to database
        $model = $this->model('audiences');

        // Get all the users
        $data_list = $model->index();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);

    }

    public function get_audience_by_id()
    {

        // get data
        $data = json_decode(file_get_contents("php://input"));
        $audience_id = $data->audience_id;

        // Connect to database
        $model = $this->model('audiences');

        // Get all the users
        $data_list = $model->get_audience_by_id($audience_id);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function get_audience_accounts()
    {
        // get data
        $data = json_decode(file_get_contents("php://input"));
        $audience_id = $data->audience_id;

        // Connect to database
        $model = $this->model('audiences');

        // Get all the users
        $data_list = $model->get_audience_accounts($audience_id);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }





}