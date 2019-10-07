<?php

use MVC\Controller;

class ControllersCreativesChannels extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('creativesChannels');

        // Get all the users
        $data_list = $model->index();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);

    }







}