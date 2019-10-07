<?php

use MVC\Controller;

class ControllersSchedules  extends Controller
{

    public function index() {

        // Connect to database
        $model = $this->model('schedules');

        // Get all the users
        $data_list = $model->getAllApprovedCampaigns();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function schedules($params)
    {

        $model = $this->model('schedules');
        // Get all the users
        $data_list = $model->getUserApprovedSchedules($params);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($params);
    }

    public function approvedCampaigns()
    {
        $user_id = $this->request->request['user_id'];
        $offernet_account_id = $this->request->request['offernet_account_id'];

        $model = $this->model('schedules');
        // Get all the users
        $data_list = $model->getUserApprovedCampaigns($user_id, $offernet_account_id);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function userAccounts()
    {

    }


}
