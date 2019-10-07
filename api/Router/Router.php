<?php

/**
 * web interface paths
 */


$router->get('/', function() {
	include_once VIEWS . "introduction.php";
});

$router->get('/web/products', function() {
	include_once VIEWS . "products.php";
});

$router->get('/web/categories', function() {
    include_once VIEWS . "categories.php";
});

$router->get('/web/users', function() {
    include_once VIEWS . "users.php";
});


/**
 * api paths
 */


// list all the users
$router->get('/api/users', 'Users@index');


// list all products
$router->get('/api/products', 'Products@index');

// list all categories
$router->get('/api/categories', 'Categories@index');




// //// Get All Books And Authors
// //$router->get('/all', 'Books@index');
// //
// //// install system
// //$router->get('/install', 'System@index');
// //
// //// books router
// //$router->get('/books', 'Books@books');
// //$router->get('/books/:page', 'Books@books');
// //
// //// search books
// //$router->get('/books/title/:title', 'Books@searchBooksByTitle');
// //$router->get('/books/title/:title/:page', 'Books@searchBooksByTitle');
// //
// //$router->get('/books/isbn/:isbn', 'Books@searchBooksByISBN');
// //
// //$router->get('/books/author/:author', 'Books@searchBooksByAuthors');
// //$router->get('/books/author/:author/:page', 'Books@searchBooksByAuthors');
// //
// //// authors router
// //$router->get('/authors', 'Books@authors');
// //$router->get('/authors/:page', 'Books@authors');
// //
// //// search author
// //$router->get('/authors/:author', 'Books@searchBooksByAuthors');
// //$router->get('/authors/:author/:page', 'Books@searchBooksByAuthors');
// //


// /**
//  * Offernet Api
//  *
//  *
//  **/

// // Platform Login
// $router->get('/api/v1/login', 'Login@index');
// $router->post('/api/v1/login', 'Login@login');
// //$router->post('/api/v1/login', 'Login@checkefemailexists');




// // API Endpoints & Description
// $router->get('/api/v1/endpoints', 'Endpoints@listAllEndpoints');

// // Users
// $router->get('/api/v1/users', 'Users@index');


// // Accounts
// //$router->get('/api/v1/accounts', 'Accounts@getAllAccounts');

// $router->get('/api/v1/getallocatedusers/:user_id', 'Users@getAllocatedUsers');
// $router->get('/api/v1/allusers', 'Users@getAllUserCheckinStatus');


// /**
//  * Creatives Builder EndPoints
//  *
//  **/
// // Accounts
// $router->post('/api/v1/accounts', 'Accounts@index');
// //$router->post('/api/v1/accounts', 'Accounts@get_grouped_accounts_detailed');
// $router->post('/api/v1/accounts2', 'Accounts@get_accounts');
// $router->post('/api/v1/accounts_detailed', 'Accounts@get_accounts_detailed');

// //////////////////////////////// Creative Accounts
// $router->post('/api/v1/accounts/get_creative_accounts', 'Accounts@get_creative_accounts');
// $router->post('/api/v1/accounts/set_creative_accounts', 'Accounts@set_creative_accounts');

// $router->post('/api/v1/clients', 'Accounts@get_clients');

// $router->post('/api/v1/clients_accounts', 'Accounts@get_clients_accounts');
// $router->post('/api/v1/clients_accounts2', 'Accounts@get_clients_accounts2');
// //$router->post('/api/v1/clients_accounts2', 'Accounts@get_clients_accounts_by_user_id');

// /////////////////////////////// Creatives
// $router->get('/api/v1/creatives', 'Creatives@get_all_creatives');
// $router->get('/api/v1/creatives/id/:creative_id', 'Creatives@get_creative_by_id');
// $router->post('/api/v1/creatives', 'Creatives@new_creative');

// //$router->post('/api/v1/creatives/save_accounts', 'Creatives@save_accounts');
// //$router->post('/api/v1/creatives/save_channels', 'Creatives@save_channel');


// $router->post('/api/v1/test', 'Test@index');



// ///////////////////////////// Channels and Types
// $router->get('/api/v1/creatives/channels', 'CreativesChannels@index');
// $router->get('/api/v1/creatives/channel_types', 'CreativesTypes@index');
// $router->get('/api/v1/creatives/channel_types/:channel_id', 'CreativesTypes@get_types_by_channel_id');




// ////////////////////////////// SMS
// $router->post('/api/v1/creatives/channel/sms/all', 'CreativesSms@index');
// $router->post('/api/v1/creatives/channel/sms/by_id', 'CreativesSms@get_sms_by_id');
// $router->post('/api/v1/creatives/channel/sms/by_name', 'CreativesSms@get_sms_by_id');
// $router->post('/api/v1/creatives/channel/sms/save', 'CreativesSms@save_sms_creatives');
// $router->post('/api/v1/creatives/channel/sms/update', 'CreativesSms@update_sms_creatives');




// /////////////////////////////// Emails
// $router->get('/api/v1/creatives/channel/email/all', 'CreativesEmail@index');
// $router->post('/api/v1/creatives/channel/email/by_id', 'CreativesEmail@get_email_by_id');
// $router->post('/api/v1/creatives/channel/email/save', 'CreativesEmail@save_email_creatives');
// $router->post('/api/v1/creatives/channel/email/update', 'CreativesEmail@update_email_creatives');
// $router->post('/api/v1/creatives/channel/email/send_test', 'CreativesEmail@send_test');




// /////////////////////////////// Google
// $router->post('/api/v1/creatives/channel/google/all', 'CreativesGoogle@index');
// $router->post('/api/v1/creatives/channel/google/save', 'CreativesGoogle@save');
// $router->post('/api/v1/creatives/channel/google/get_by_id', 'CreativesGoogle@get_by_id');
// $router->post('/api/v1/creatives/channel/google/get_by_name', 'CreativesGoogle@get_by_name');



// /////////////////////////////// Facebook
// $router->post('/api/v1/creatives/channel/facebook/all', 'CreativesFacebook@index');
// $router->post('/api/v1/creatives/channel/facebook/save', 'CreativesFacebook@save');
// $router->post('/api/v1/creatives/channel/facebook/get_by_id', 'CreativesFacebook@get_by_id');
// $router->post('/api/v1/creatives/channel/facebook/get_by_name', 'CreativesFacebook@get_by_name');


















// // user checkIn system
// $router->post('/api/v1/allusers/:userId', 'Users@getAllAllocatedUsers');
// $router->get('/api/v1/userscheckinstatus', 'Users@getAllUserCheckinStatus');
// $router->post('/api/v1/setuserstart/:userId/:ipadress', 'Users@setUserAttendanceStart');
// $router->post('/api/v1/setuserend/:userId/:ipadress', 'Users@setUserAttendanceEnd');
// $router->post('/api/v1/deleteuser/:userId', 'Users@deleteUser');


// /**
//  *
//  * DreamCity
//  *
//  */

// $router->post('/api/v1/dreamcity', 'Dreamcity@save_info');















// $router->post('/api/v1/billing', 'Billing@getInfo');









// // Campaigns
// $router->get('/api/v1/campaigns', 'Campaigns@index');

// /**
//  * Campaign Schedules
//  */

// // GET Requests
// $router->get('/api/v1/schedules', 'Schedules@index');
// $router->get('/api/v1/schedules/:campaign_id', 'Schedules@scheduleCampaign');

// // POST Requests
// $router->post('/api/v1/schedules', 'Schedules@index');
// $router->post('/api/v1/schedules/approved_campaigns', 'Schedules@approvedCampaigns');
// $router->post('/api/v1/schedules/user_accounts', 'Schedules@userAccounts');

// /**
//  * Reports
//  */
// $router->get('/api/v1/reports', 'Reports@index');

// /**
//  * DBQueries - experimental
//  */
// //$router->get('/api/v1/dbquery', 'DBQueries@runQuery');
// //$router->post('/api/v1/dbquery', 'DBQueries@runQuery');
// $router->post('/api/v1/dbquery', 'DBQueries@custom_query');


// /**
//  * Audiences Manager
//  */
// $router->get('/api/v1/audiences/get_audiences', 'Audiences@get_audiences');
// $router->post('/api/v1/audiences/get_audience', 'Audiences@get_audience_by_id');
// $router->post('/api/v1/audiences/get_audience_accounts', 'Audiences@get_audience_accounts');


// $router->get('/api/v1/facebook/get_me', 'Fb@fb_sdk');
// $router->get('/api/v1/facebook/fb_get_graph_user', 'Fb@fb_get_graph_user');
// $router->get('/api/v1/facebook/fb_adaccount_info', 'Fb@fb_adaccount_info');






