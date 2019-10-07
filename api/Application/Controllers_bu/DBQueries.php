<?php

use MVC\Controller;

class ControllersDBQueries  extends Controller
{

    public function index() {

        // Connect to database
        $model = $this->model('dbqueries');

        // Get all the users
        $data_list = $model->getAllApprovedCampaigns();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function rawQuery()
    {

        $query = $this->request->request['query'];

        $model = $this->model('dbqueries');
        // Get all the users
        $data_list = $model->runQuery($query);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function runQuery()
    {
        $data = json_decode(file_get_contents("php://input"));
        $query = $data->query;

        // Connect to database
        $model = $this->model('dbqueries');

        // Get all the users
        $data_list = $model->execQuery($query);

        echo json_encode($data_list);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);


    }


    public function custom_query()
    {
        $query = $this->request->request['query'];
        if ($query == '') {
            $data = json_decode(file_get_contents("php://input"));
            $query = $data->query;
        }

        // Connect to database
        $model = $this->model('dbqueries');

        // Get all the users
        $data_list = $model->execQuery($query);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);


    }



}
