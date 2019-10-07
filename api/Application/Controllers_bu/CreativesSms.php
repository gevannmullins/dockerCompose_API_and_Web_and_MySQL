<?php

use MVC\Controller;

class ControllersCreativesSms extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('creativessms');

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
        $this->response->setContent($data_list);

    }


    public function endpoints()
    {
        $endpoints = [

            '/api/v1/accounts/all' => [
                'description' => 'Returns a list of all the accounts',
                'methods' => ['GET','POST'],
                'params' => 'none',
                'returnSample' => [
                    'accountId' => '12',
                    'accountName' => 'Test Account'
                ]

            ]

        ];
        $this->response->sendStatus(200);
        $this->response->setContent($endpoints);

    }


    public function save_sms_creatives()
    {

        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $creative_id = $data->creative_id;
        $creative_name = $data->creative_name;

        $creative_update = [];
        $creative_update = [
            "creative_name" => $creative_name,
            "creative_id" => $creative_id
        ];

        $model = $this->model('creativesSms');
        $data_list = $model->saveSmsCreative($data);

        $model2 = $this->model('creatives');
        $data_list = $model2->update_creative($creative_update);

        $returnData['status'] = 'success';
//        $returnData['creative_id'] = $data_list;

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }





}