<?php

use MVC\Controller;

class ControllersTest extends Controller
{

    public function index()
    {

        $model = $this->model('test');
        $data_list = $model->getTest();

        $this->response->setContent($data_list);

    }


}