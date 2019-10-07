<?php

use MVC\Controller;

class ControllersCreatives extends Controller
{


    public function index()
    {

        // Connect to database
        $model = $this->model('creatives');

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

    public function get_channels()
    {

        // Connect to database
        $model = $this->model('creatives');

        $returnData = [];
        $returnData['status'] = 'success';

        // Get all the channels
        $returnData['channels'] = $model->creatives_channels();


        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }

    public function channel_types()
    {

        // Connect to database
        $model = $this->model('creatives');

        $returnData = [];
        $returnData['status'] = 'success';

        // Get all the channels
        $returnData['channel_types'] = $model->types();


        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }

    public function get_all_creatives()
    {
        $model = $this->model('creatives');
        $data_list = $model->getAllCreatives();

        $returnData = [];
        $returnData['status'] = 'success';
        $returnData['creatives'] = $data_list;
        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);
    }

    public function get_creative_by_id()
    {
        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $creative_id = $data->creative_id;
        $model = $this->model('creatives');
        $data_list = $model->getCreativeById($creative_id);

        $returnData['status'] = 'success';
        $returnData['creative'] = $data_list;
        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);
    }

    public function get_creative_by_name()
    {
        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $creative_name = $data->creative_name;
        $model = $this->model('creatives');
        $data_list = $model->getCreativeByName($creative_name);

        $returnData['status'] = 'success';
        $returnData['creative'] = $data_list;
        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);
    }

    public function get_creative_by_channel()
    {
        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $creative_channel = $data->channel_id;
        $model = $this->model('creatives');
        $data_list = $model->getCreativesByChannel($creative_channel);

        $returnData = [];
        $returnData['status'] = 'success';
        $returnData['creative'] = $data_list;
        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);
    }

    public function new_creative()
    {
        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $model = $this->model('creatives');
        $data_list = $model->new_creative($data);
        $returnData['status'] = 'success';
        $returnData['creative_id'] = $data_list;

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }




}