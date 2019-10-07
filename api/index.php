<?php

// show error reporting
error_reporting(E_ALL);

// set your default time-zone
date_default_timezone_set('Asia/Manila');
//
//// variables used for jwt
//$key = "example_key";
//$iss = "http://php.offernet.api";
//$aud = "http://php.offernet.net";
//$iat = 1356999524;
//$nbf = 1357000000;

require_once "./vendor/autoload.php";


//include_once 'config/core.php';
include_once './vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once './vendor/firebase/php-jwt/src/ExpiredException.php';
include_once './vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once './vendor/firebase/php-jwt/src/JWT.php';
use \Firebase\JWT\JWT;




//new \Firebase\JWT\JWT();
//$handler = new \ByJG\Session\JwtSession('php.offernet.api', 'your super secret key');
//$handler->replaceSessionHandler(true);

//
//
//$key = "example_key";
//$token = array(
//    "iss" => "http://php.offernet.api",
//    "aud" => "http://php.offernet.api",
//    "iat" => 1356999524,
//    "nbf" => 1357000000
//);
//
///**
// * IMPORTANT:
// * You must specify supported algorithms for your application. See
// * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
// * for a list of spec-compliant algorithms.
// */
//$jwt = JWT::encode($token, $key);
//$decoded = JWT::decode($jwt, $key, array('HS256'));
//
//print_r($decoded);
//
///*
// NOTE: This will now be an object instead of an associative array. To get
// an associative array, you will need to cast it as such:
//*/
//
//$decoded_array = (array) $decoded;
//
///**
// * You can add a leeway to account for when there is a clock skew times between
// * the signing and verifying servers. It is recommended that this leeway should
// * not be bigger than a few minutes.
// *
// * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
// */
//JWT::$leeway = 60; // $leeway in seconds
//$decoded = JWT::decode($jwt, $key, array('HS256'));
//



// load config and startup file
require 'config.php';
require SYSTEM . 'Startup.php';

// using
use Router\Router;

// create object of request and response class
$request = new Http\Request();
$response = new Http\Response();

// pagination
$pagination = new Pagination\Pagination();



// set default header
$response->setHeader('Access-Control-Allow-Origin: *');
$response->setHeader("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
$response->setHeader('Content-Type: application/json; charset=UTF-8');

// set request url and method
$router = new Router('/' . strtolower($request->getUrl()), $request->getMethod());

// // check install 
// $file = SCRIPT . 'SQL/library-sql.sql';
// if (file_exists($file) && strtolower($request->getUrl()) !== 'install') {
//     exit('Your System Not Installed please try with /install');
// }

// import router file
require 'Router/Router.php';

// Router Run Request
$router->run();

// Response Render Content
$response->render();

?>
