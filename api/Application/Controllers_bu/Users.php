<?php

use MVC\Controller;

class ControllersUsers  extends Controller {

    public function index() {

        // Connect to database
        $model = $this->model('users');

        // Get all the users
        $data_list = $model->getAllUsers();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }

    public function users() {

        $model = $this->model('users');
        // Get all the users
        $data_list = $model->getAllUsers();

        // Send Response
        $this->response->sendStatus(200);
        $this->response->setContent($data_list);
    }
    
    public function getAllocatedUsers($param){

        $id;
        foreach ($param as $key => $value) {
            $id = $value;
        }

        $model = $this->model('users');
        $data_list = $model ->getAllAllocatedUsers($id);
        if(!empty($data_list)){
            
            $this->response->sendStatus(200);
            $this->response->setContent($data_list);   
        
        } else {

            $returnArray = array('error' => 'Invalid user ID or password.');
            $this->response->sendStatus(401);
            $this->response->setContent($returnArray);
        
        }
    }

    public function setUserAttendanceStart($param){
       
        $id; 
        $ip;
          foreach ($param as $key => $value) {
           $id = $param['userId'];
           $ip = $param['ipadress'] ;

        }


        $model = $this->model('users');
        $status  = $model -> setUserAttendanceStart($id , $ip);
        
        
    
        if($status){
            
            $this->response->sendStatus(200);
            $this->response->setContent('User Logged in');   
        
        } else {

            $returnArray = array('error' => 'Invalid user ID or password.');
            $this->response->sendStatus(401);
            $this->response->setContent($returnArray);
        
        }    

    }


    public function getAllUserCheckinStatus(){


        $id;
        foreach ($param as $key => $value) {
            $id = $value;
        }

        $model = $this->model('users');
        $data_list = $model ->getAllUserCheckinStatus($id);
        if(!empty($data_list)){
            
            $this->response->sendStatus(200);
            $this->response->setContent($data_list);   
        
        } else {

            $returnArray = array('error' => 'Invalid user ID or password.');
            $this->response->sendStatus(401);
            $this->response->setContent($returnArray);
        }


    }

    public function deleteUser($param){
            $id; 
        foreach ($param as $key => $value) {
           $id = $param['userId'];
        }

        $model = $this->model('users');
        $status  = $model -> deleteUser($id);


        if($status){
            
            $this->response->sendStatus(200);
            $this->response->setContent('User Has been Deleted');   
        
        } else {

            $returnArray = array('error' => 'Invalid user ID or password.');
            $this->response->sendStatus(401);
            $this->response->setContent($returnArray);
        
        }    


    }




    public function setUserAttendanceEnd($param){
        
        $id; 
        $ip;
        
        foreach ($param as $key => $value) {
           $id = $param['userId'];
           $ip = $param['ipadress'] ;
        }

        $model = $this->model('users');
        $status  = $model -> setUserAttendanceEnd($id,$ip);
        


        if($status){
            
            $this->response->sendStatus(200);
            $this->response->setContent('User Logged Out');   
        
        } else {

            $returnArray = array('error' => 'Invalid user ID or password.');
            $this->response->sendStatus(401);
            $this->response->setContent($returnArray);
        
        }    

    }


}