<?php

//date_default_timezone_set('Africa/Johannesburg');
//require_once '../../dsendmail2/dSendMail2.inc.php';
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;
//
use MVC\Controller;

class ControllersCreativesEmail extends Controller
{

    public function index()
    {

        // Connect to database
        $model = $this->model('creativesEmail');

        // Get all the users
        $data_list = $model->index();
        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);

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


    public function save_email_creatives()
    {

        $returnData = [];
        $data = json_decode(file_get_contents("php://input"));

        $model = $this->model('creativesEmail');
        $data_list = $model->saveEmailCreative($data);
        $returnData['status'] = 'success';
        $returnData['creative_id'] = $data_list;

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($returnData);

    }
//
//
//    public function send_test2()
//    {
//        $returnData = ["Status" => "Email has been sent."];
//        $data = json_decode(file_get_contents("php://input"));
//
//        $email_to = $data->test_email_address;
//        $email_subject = "Test email";
//        $email_body = $data->email_content;
//        $email_headers = "MIME-Version: 1.0" . "\r\n";
//        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $email_headers .= "From: admin@bastionflowe.com" . "\r\n" . "CC: gevannm@bastionflowe.com";
//        $email_parameters = "";
//
//        mail($email_to,$email_subject,$email_body,$email_headers,$email_parameters);
//
//        // Send Response
//        $this->response->sendStatus(200);
//        $this->response->setContent($returnData);
//    }
//
//    public function send_test()
//    {
//
//        require '../../PHPMailer/src/Exception.php';
//        require '../../PHPMailer/src/PHPMailer.php';
//        require '../../PHPMailer/src/SMTP.php';
//
////print_r($_POST);
////
////        $returnData = ["Status" => "Email has been sent."];
////        $data = json_decode(file_get_contents("php://input"));
////
////        $email_to = $data->test_email_address;
////        $Subject = "Test email";
////        $FromEmail = "gevannm@bastionflowe.com";
////        $email_body = $data->email_content;
////        $email_headers = "MIME-Version: 1.0" . "\r\n";
////        $email_headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
////        $email_headers .= "From: admin@bastionflowe.com" . "\r\n" . "CC: gevannm@bastionflowe.com";
////        $email_parameters = "";
////
////
//        $Subject = empty(!$_POST['EmailSubject']) ? $_POST['EmailSubject'] : '❽ Lead Gener8or - Email Preview';
//        $FromEmail = empty(!$_POST['EmailReplyFrom']) ? $_POST['EmailReplyFrom'] : 'online@offernet.net';
//        $FromDisplay = empty(!$_POST['FromDisplay']) ? $_POST['FromDisplay'] : 'Bastion & Flowe';
//        $message = isset($_POST['EmailerContent']) ? $_POST['EmailerContent'] : '';
//        $toAddress = empty(!$_POST['TestSendEmail']) ? $_POST['TestSendEmail'] : 'gevannm@bastionflowe.com';
//        $name = 'Lead Gener8or User';
//        $subject = '=?UTF-8?B?'.base64_encode($Subject).'?=';
//
//
//        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
//        try {
//            //Server settings
//            $mail->SMTPDebug = 0;                                 // Enable verbose debug output  2
//            $mail->isSMTP();
//            // Set mailer to use SMTP
////	$mail->Host = '77.104.162.225';  // Specify main and backup SMTP servers
//            $mail->Host = 'mail.offernet.net';  // Specify main and backup SMTP servers
//            $mail->SMTPAuth = true;                               // Enable SMTP authentication
//            $mail->Username = 'online+offernet.net';                 // SMTP username
//            $mail->Password = 'Ch4rl13br0wn';                           // SMTP password
//            $mail->SMTPSecure = 'tls';
//            $mail->Port = 25;                                     // TCP port to connect to
//
//            //Recipients
//            $mail->setFrom('online@offernet.net', $FromDisplay);
//            $mail->addAddress($toAddress, $name);     // Add a recipient
////    $mail->addAddress('ellen@example.com');               // Name is optional
//            $mail->addReplyTo('online@offernet.net', $FromDisplay);
////    $mail->addCC('jeanm@bastionflowe.com');
//            $mail->addBCC('jeanm@bastionflowe.com');
//
//            //Attachments
////    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
////    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//
//            //Content
//            $mail->isHTML(true);                                  // Set email format to HTML
//            $mail->Subject = $subject;
//            $mail->Body = $message;
////    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//
//            //$mail->AddEmbeddedImage('img/2u_cs_mini.jpg', 'logo_2u');    //embed images
//            //and on the <img> tag put src='cid:logo_2u'
//            $mail->SMTPOptions = array(
//                'ssl' => array(
//                    'verify_peer' => false,
//                    'verify_peer_name' => false,
//                    'allow_self_signed' => true
//                )
//            );
//
//            $mail->send();
////		echo "Message has been sent <br />";
////	return true;
//            echo '1';
//        } catch (Exception $e) {
////	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo."<br />";
//            echo '0';
//        }
//    }
//

}