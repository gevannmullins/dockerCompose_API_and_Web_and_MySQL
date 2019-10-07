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
define('APPROOT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/');
define('APPVIEWS', APPROOT . 'libs/');
define('APPLIBS', APPROOT . 'views/');
