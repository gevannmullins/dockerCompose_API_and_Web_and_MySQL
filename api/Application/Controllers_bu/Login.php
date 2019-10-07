<?php

use \MVC\Controller;
use \Firebase\JWT\JWT;

class ControllersLogin extends Controller
{

    public $login;


    public function index()
    {

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $secret_key = "YOUR_SECRET_KEY";
        $jwt = null;

        $data = json_decode(file_get_contents("php://input"));
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];

        $arr = explode(" ", $authHeader);
        $data_list = $arr;




//             Connect to database
        $this->login = $this->model('login');



        // Get all the users
//        $data_list = ["message" => "This is the login index"];

        $this->response->sendStatus(200);
        $this->response->setContent($data_list);


    }

    public function login()
    {

        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        $data = json_decode(file_get_contents("php://input"));
        $firstname = $data->first_name;
        $last_name = $data->last_name;
        $username = $data->username;
        $password = md5($data->password);


        // Connect to database
        $model = $this->model('login');

        // Get all the users
        $data_list = $model->userLogin($username)[0];

        $id = $data_list['user_id'];
        $username2 = $data_list['username'];
        $firstname = $data_list['first_name'];
        $lastname = $data_list['surname'];
        $password2 = $data_list['password'];



        if (($username == $username2) && ($password == $password2)) {
            require_once('jwt.php');
            /**
             * Create some payload data with user data we would normally retrieve from a
             * database with users credentials. Then when the client sends back the token,
             * this payload data is available for us to use to retrieve other data
             * if necessary.
             */
            $userId = '1';
            /**
             * Uncomment the following line and add an appropriate date to enable the
             * "not before" feature.
             */
            // $nbf = strtotime('2021-01-01 00:00:01');
            /**
             * Uncomment the following line and add an appropriate date and time to enable the
             * "expire" feature.
             */
            // $exp = strtotime('2021-01-01 00:00:01');
            // Get our server-side secret key from a secure location.
            $serverKey = '5f2b5cdbe5194f10b3241568fe4e2b24';
            // create a token
            $payloadArray = array();
            $payloadArray['userId'] = $userId;
            if (isset($nbf)) {
                $payloadArray['nbf'] = $nbf;
            }
            if (isset($exp)) {
                $payloadArray['exp'] = $exp;
            }
            $token = JWT::encode($payloadArray, $serverKey);
            // return to caller
            $returnArray = array('token' => $token);
            $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
//            echo $jsonEncodedReturnArray;


            $secret_key = "5f2b5cdbe5194f10b3241568fe4e2b24";
            $issuer_claim = "THE_ISSUER"; // this can be the servername
            $audience_claim = "THE_AUDIENCE";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim + 10; //not before in seconds
            $expire_claim = $issuedat_claim + 60; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id,
                    "firstname" => $firstname,
                    "lastname" => $lastname,
                    "email" => $username
                ));


            $jwt = JWT::encode($token, $secret_key);
//            $this->response->setContent(
//                array(
//                    "message" => "Successful login.",
//                    "jwt" => $jwt,
//                    "email" => $username,
//                    "expireAt" => $expire_claim
//                )
//            );

            $this->response->setContent($returnArray);



            // Send Response
            $this->response->sendStatus(200);
            // $this->response->setContent($data_list);
//            $this->response->setContent($data_list);

        }else {
            $returnArray = array('error' => 'Invalid user ID or password.');
            $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
            echo $jsonEncodedReturnArray;
        }



    }






//    public function checkIfEmailExists()
//    {
//        $data = $this->request;
//
//        $returnData = [];
//        $iss=[];
//        $aud=[];
//        $iat=[];
//        $nbf=[];
//        $user = [];
//
//        $email_exists = $data['email'];
//        $password = $data['password'];
//
//        // check if email exists and if password is correct
//        if($email_exists && password_verify($password, $password)){
//
//            $token = array(
//                "iss" => $iss,
//                "aud" => $aud,
//                "iat" => $iat,
//                "nbf" => $nbf,
//                "data" => array(
//                    "id" => $user->id,
//                    "firstname" => $user->firstname,
//                    "lastname" => $user->lastname,
//                    "email" => $user->email
//                )
//            );
//
//            // set response code
//            http_response_code(200);
//
//            // generate jwt
//            $jwt = JWT::encode($token, $key);
//            $returnData = json_encode(
//                array(
//                    "message" => "Successful login.",
//                    "jwt" => $jwt
//                )
//            );
//
//            return $returnData;
//
//        }else{
//
//            // set response code
//            http_response_code(401);
//
//            // tell the user login failed
//            return $returnData;
//        }
//
//    }






}