<?php

use MVC\Controller;

class ControllersCreativesAccounts extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('accounts');

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

    public function getAllAccounts()
    {

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $data_list = $model->accounts();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);


    }





}