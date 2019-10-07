<?php

use MVC\Controller;

class ControllersCreativesTypes extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('creativesTypes');

        // Get all the users
        $data_list = $model->index();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);

    }

    public function get_types_by_channel_id($params)
    {
        // Connect to database
        $model = $this->model('creativesTypes');

        // Get all the users
        $data_list = $model->getTypesByChannelId($params['channel_id']);

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);

    }







}