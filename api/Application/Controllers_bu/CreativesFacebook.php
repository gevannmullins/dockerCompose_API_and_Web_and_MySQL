<?php

use MVC\Controller;

class ControllersCreativesFacebook extends Controller
{

    public function index($param)
    {

        $data = json_decode(file_get_contents("php://input"));
        if ($data == '') {
            $data = $this->request;
        }
//        $data[] = $param;
        // Connect to database
//        $model = $this->model('accounts');

        // Get all the users
//        $data_list = $model->accounts();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);

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

    /**
     * @fields: [
     * 'uploadSingleImageFile',
     * 'photoText',
     * 'websiteUrlCheckPhoto',
     * 'photoWebsiteUrl',
     * 'photoDisplayLink',
     * 'photoHeadline',
     * 'photoFeedDescription',
     * 'callToActionTypePhoto'
     * ]
     */
    public function saveSingleImage()
    {


        $data = $this->request;
        if ($data == '') {
            $data = json_decode(file_get_contents("php://input"));
        }
        // Connect to database
//        $model = $this->model('accounts');

        // Get all the users
//        $data_list = $model->accounts();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data);


    }


    /**
     * @fields: [
     * 'videoUpload',
     * 'photoText',
     * 'videoText',
     * 'videoWebsiteUrlCheck',
     * 'videoWebsiteUrl',
     * 'videoDisplayLink',
     * 'videoHeadline',
     * 'videoFeedDescription',
     * 'callToActionTypeVideo'
     * ]
     */
    public function saveSingleVideo()
    {

    }


    /**
     * @fields: [
     * 'carouselText',
     *
     * ]
     */
    public function saveCarousel()
    {

    }


    /**
     * @fields: [
     * '',
     *
     * ]
     */
    public function saveSlideShow()
    {

    }



    /**
     * @fields: [
     * '',
     *
     * ]
     */
    public function save360Video()
    {

    }



    /**
     * @fields: [
     * '',
     *
     * ]
     */
    public function saveCanvas()
    {

    }





}