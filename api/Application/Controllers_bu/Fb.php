<?php

require_once SCRIPT . 'vendor/autoload.php'; // change path as needed


use MVC\Controller;
use Facebook\Facebook;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

//require_once SCRIPT . 'vendor/autoload.php'; // change path as needed

class ControllersFb extends Controller
{

    public $app_id;
    public $app_secret;
    public $app_token;
    public $fb;

    public function __construct()
    {
        require_once SCRIPT . 'vendor/autoload.php'; // change path as needed
        $this->app_id = '132594367339644';
        $this->app_secret = 'b95cc1a0a72d7b023c4856189f5c77b8';
        $this->app_token = 'EAAB4mAgqHHwBACQOb6aRhFU5bYTCzXXAAu9YZC3VFOZC5yEBI3b2rUGCZCIDVCOZCRQYZAIPneyI4b6g0vNu4QU5ZAhhGen3BEHRXwgPvn7eSuLRibOeZCeNL7N03wMlyrUXYSZAJADqy2lscQmy9lb6b1ykwALvg4o476JlnK71AQZDZD';
        $this->fb = new Facebook\Facebook([
            'app_id' => $this->app_id,
            'app_secret' => $this->app_secret,
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

    }

    public function fb_sdk()
    {

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $this->fb->get('/me', $this->app_token);
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        return 'Logged in as ' . $me->getName();
    }

    public function fb_get_graph_user()
    {
        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('/me?fields=id,name', $this->app_token);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $response;
    }

    public function fb_adaccount_info()
    {
        require SCRIPT . 'vendor/autoload.php';
        $this->app_id = '132594367339644';
        $this->app_secret = 'b95cc1a0a72d7b023c4856189f5c77b8';
        $this->app_token = 'EAAB4mAgqHHwBACQOb6aRhFU5bYTCzXXAAu9YZC3VFOZC5yEBI3b2rUGCZCIDVCOZCRQYZAIPneyI4b6g0vNu4QU5ZAhhGen3BEHRXwgPvn7eSuLRibOeZCeNL7N03wMlyrUXYSZAJADqy2lscQmy9lb6b1ykwALvg4o476JlnK71AQZDZD';


        $access_token = $this->app_token;
        $app_secret = $this->app_secret;
        $app_id = $this->app_id;
        $id = '404606936742100';

        $api = Api::init($app_id, $app_secret, $access_token);
        $api->setLogger(new CurlLogger());

        $fields = array(
            'name',
            'objective',
        );
        $params = array(
            'effective_status' => array('ACTIVE','PAUSED'),
        );
        return json_encode((new AdAccount($id))->getCampaigns(
            $fields,
            $params
        )->getResponse()->getContent(), JSON_PRETTY_PRINT);
    }

}