<?php

/**
 *  Config File For Handel Route, Database And Request
 * 
 *  Author: Gevann Mullins
 *  Email: gevann.mullins@gmail.com
 *  
 */

$currentDomain = preg_replace('/www\./i', '', $_SERVER['SERVER_NAME']);
$protocol=strpos(strtolower($_SERVER['SERVER_PROTOCOL']),'https') === FALSE ? 'http' : 'https';
$domainLink=$protocol.'://'.$_SERVER['HTTP_HOST'];
$url=$protocol.'://'.$_SERVER['HTTP_HOST'].'?'.$_SERVER['QUERY_STRING'];

// Http Default Url
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
define('HTTP_URL', '/'. substr_replace(trim($_SERVER['REQUEST_URI'], '/'), '', 0, strlen($scriptName)));
define('THISDOMAIN', $currentDomain . '/');
define('THISPROTOCOL', $protocol);
define('DOMAINLINK', $domainLink . '/');
define('THISURL', $url);

// Define Path Application
define('SCRIPT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/');
define('SYSTEM', SCRIPT . 'System/');
define('CONTROLLERS', SCRIPT . 'Application/Controllers/');
define('MODELS', SCRIPT . 'Application/Models/');
define('VIEWS', SCRIPT . 'Application/Views/');

// Config Database
//define('DATABASE', [
//    'Port'   => '3306',
//    'Host'   => 'localhost',
//    'Driver' => 'PDO',
//    'Name'   => 'offernet_api',
//    'User'   => 'root',
//    'Pass'   => 'root',
//    'Prefix' => ''
//]);

define('DATABASE', [
    'Port'      => '3306',
    'Host'      => 'localhost',
    'Driver'    => 'PDO',
    'Name'      => 'api_database',
    'User'      => 'admin',
    'Pass'      => 'admin'
]);


// DB_PREFIX
define('DB_PREFIX', '');

// For Limit Page
define('LIMIT_PRE_PAGE_SHOW_BOOKS', 5);
