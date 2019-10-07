<?php

use MVC\Controller;

class ControllersAccounts extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $data_list = $model->index2();
        $returnData = [];
        $returnData['status'] = 'success';
//        foreach($data_list as $key=>$value){
//            $returnData['clients'][$value['client_name']][] = [
//                "account_id" => $value['account_id'],
//                "account_name" => $value['account_name']
//            ];
//        }

        foreach($data_list as $key=>$value){
            $returnData['clients'][$value['client_name']][] = $value;
        }


        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }

    public function get_grouped_accounts_detailed()
    {

        // get data
        $data = json_decode(file_get_contents("php://input"));
        $user_id = $data->user_id;

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $data_list = $model->index($user_id);
        $returnData = [];
        $returnData['status'] = 'success';
        foreach($data_list as $key=>$value){
            $returnData['clients'][$value['client_name']][] = $value;
        }

//        // Send Response
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

    public function get_accounts()
    {
        $returnData = [];
        $groupD = [];

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $accounts = $model->get_accounts();
        $client_accounts = [];
        foreach($accounts as $account){
            $client_accounts[] = [
                "account_id"=>$account["account_id"],
                "account_name"=>$account["account_name"]
            ];
        }


        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($client_accounts);


    }

    public function get_accounts_detailed()
    {
        $returnData = [];
        $groupD = [];

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $accounts = $model->get_accounts();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($accounts);


    }

    public function get_clients()
    {
        $returnData = [];
        $groupD = [];

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $accounts = $model->get_clients();
//        $client_accounts = [];
//        foreach($accounts as $account){
//            $client_accounts[] = [
//                "account_id"=>$account["account_id"],
//                "account_name"=>$account["account_name"]
//            ];
//        }

//        if(!empty($client_accounts)){
//            $groupD[] = [
//                "groupName"=>$client["client_name"],
//                "groupData"=>$client_accounts
//            ];
//        }

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($accounts);


    }

    public function get_clients_accounts()
    {
        $returnData = [];
        $groupD = [];

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $clients = $model->get_clients();
        $accounts = $model->get_accounts();
        foreach($clients as $client){
            $client_id = $client['client_id'];

            $client_accounts = [];
            foreach($accounts as $account){

                if($account['client_id']==$client_id){
                    $client_accounts[] = [
                        "account_id"=>$account["account_id"],
                        "account_name"=>$account["account_name"],
                        "detail" => $account
                    ];
                }
            }

            if(!empty($client_accounts)){
                $groupD[] = [
                    "groupName"=>$client["client_name"],
                    "groupData"=>$client_accounts
                ];
            }


        }

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($groupD);


    }

    public function get_clients_accounts2()
    {
        $returnData = [];
        $groupD = [];

        // Connect to database
        $model = $this->model('accounts');

        // Get all the users
        $clients = $model->get_clients();
        $accounts = $model->get_accounts();
        foreach($clients as $client){
            $client_id = $client['client_id'];

            $client_accounts = [];
////            foreach($accounts as $account){
////
////                if($account['client_id']==$client_id){
////                    $client_accounts[] = [
////                        "account_id"=>$account["account_id"],
////                        "account_name"=>$account["account_name"],
////                        "detail" => $account
////                    ];
////                }
////            }
////
//            if(!empty($client_accounts)){
//                $groupD[] = [
//                    "groupName"=>$client["client_name"]
////                    "groupData"=>$client_accounts
//                ];
//            }
//
//
        }

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($clients);


    }

    public function get_clients_accounts_by_user_id($param)
    {
        $returnData = [];
        $groupD = [];

        $user_id = $param['user_id'];

        // Connect to the user model
        $user_model = $this->model('users');
        $user_level = $user_model->getUserLevel($user_id);
        // Connect to accounts model
        $accounts_model = $this->model('accounts');

        if($user_level[0]['user_level'] == 99) {
            // Get all the clients and all accounts
            $clients = $accounts_model->get_clients();
            $accounts = $accounts_model->get_accounts();
            foreach($clients as $client){
                $client_id = $client['client_id'];
                $client_accounts = [];
                foreach($accounts as $account){
                    if($account['client_id']==$client_id){
                        $client_accounts[] = [
                            "account_id"=>$account["account_id"],
                            "account_name"=>$account["account_name"]
                        ];
                    }
                }
                if(!empty($client_accounts)){
                    $groupD[] = [
                        "groupName"=>$client["client_name"],
                        "groupData"=>$client_accounts
                    ];
                }
            }
        }else{
            $groupD[] = $user_model->getUserClients($user_id);
        }

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($groupD);


    }


}