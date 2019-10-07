<?php

use MVC\Model;

class ModelsUsers extends Model
{

    public function execQuery($sql)
    {
        $query = $this->db->query($sql);
        $data = [];

        if ($query->num_rows) {
            if(sizeof($query->rows) > 0){
                foreach($query->rows as $key => $value):
                    $data[$key] = $value;
                 endforeach;
            } else {
                $data[] = true;
            }
        } else {
            $data[] = $query->rows;
        }
         return $data;
    }


    private function execQueryWorkAttendance($sql)
    {
        
        $query = $this->db->query($sql);
        $data = false;
        
        if ($query->num_rows > 0) {
            $data = true;
        } 
        
        return $data;
    }


    public function getAllUsers()
    {
        // sql statement
        $sql = "SELECT * FROM plat_users";
        return $this->execQuery($sql);

    }


    public function getAllAllocatedUsers($user_id){

        $sql = "SELECT id, name, email,role FROM platform_users.users where createdBy = $user_id";
        return $this->execQuery($sql);
        

    }


    public function deleteUser($user_id){

        $sql = "DELETE FROM platform_users.users where id = $user_id";    
        return $this->execQuery($sql);

    }    



    public function getAllUserCheckinStatus(){
        $sql = "SELECT T1.id, T1.name, T1.email,T1.role, ifnull(T2.at_work,0) AS at_work, T2.start, T2.stop
                FROM platform_users.users  AS T1
                left join platform_users.users_attendance as T2
                ON
                T1.id = T2.user_id;";
        return $this->execQuery($sql);
    }


    public function setUserAttendanceStart($user_id, $ipaddress)
    {

        $sqlCheck = "SELECT * FROM platform_users.users_attendance WHERE user_id = '$user_id'";
        $check = $this->execQueryWorkAttendance($sqlCheck);

        
        if($check){
            $sql = "UPDATE platform_users.users_attendance SET at_work = 1 , start = CURRENT_TIMESTAMP() WHERE user_id = '$user_id'";
            
        } else {
            $sql = "INSERT INTO platform_users.users_attendance(user_id, at_work, start,`date`) VALUES ('$user_id',1,CURRENT_TIMESTAMP(),CURRENT_DATE)"; 
        }

        $sql_log = "INSERT INTO platform_users.users_attendance_log(user_id, start, login_ip,`date`) VALUES ('$user_id',CURRENT_TIMESTAMP(),'$ipaddress',CURRENT_DATE)"; 
        $this->execQueryWorkAttendance($sql_log);


        return $this->execQueryWorkAttendance($sql);
    }


    public function setUserAttendanceEnd($user_id, $ipaddress)
    {

        $sqlCheck = "SELECT * FROM platform_users.users_attendance WHERE user_id = '$user_id'";
        $check = $this->execQueryWorkAttendance($sqlCheck);

        if($check){
            $sql = "UPDATE platform_users.users_attendance SET at_work = 0 , stop = CURRENT_TIMESTAMP() WHERE user_id = '$user_id'";
            $sql_log = "UPDATE platform_users.users_attendance_log SET  stop = CURRENT_TIMESTAMP() , logout_ip = '$ipaddress' WHERE user_id = '$user_id' and `date` = CURRENT_DATE";

        }
        $this->execQueryWorkAttendance($sql_log);        
        
        return $this->execQueryWorkAttendance($sql);
    }


    public function getUserInfo($user_id)
    {

        $sql = "SELECT * FROM plat_users WHERE user_id='$user_id'";
        return $this->execQuery($sql);

    }


    public function getUserAccounts($user_id)
    {

        $sql = "SELECT * FROM plat_users_accounts WHERE user_id='$user_id'";
        return $this->execQuery($sql);

    }


    public function getUserCampaigns($user_id)
    {
        $sql = "SELECT 	T1.id,
		T3.client_name,
		T1.campaign_name,
		T1.campaign_channels,
		T1.campaign_used,
		T1.campaign_status,
		T1.approval_status,
		T1.audit_date
		FROM 	platform.lg_campaigns AS T1
		INNER JOIN 	platform.lg_campaigns_clients AS T2
		ON 		T1.id = T2.campaign_id
		INNER JOIN 	platform.plat_clients AS T3
		ON 		T2.client_id = T3.client_id
		WHERE 	T3.client_id > 0						 
		AND     T1.approval_status IN (0,2,1,4,5) 
		AND     T1.brief IN (2,3);";
        return $this->execQuery($sql);


    }


    public function getUserBriefs($user_id, $offernet_account_id)
    {
        $sql = "SELECT 	T1.id,
		T3.client_name,
		T1.campaign_name,
		T1.campaign_channels,
		T1.campaign_used,
		T1.campaign_status,
		T1.approval_status,
		T1.audit_date
		FROM 	platform.lg_campaigns AS T1
		INNER JOIN 	platform.lg_campaigns_clients AS T2
		ON 		T1.id = T2.campaign_id
		INNER JOIN 	platform.plat_clients AS T3
		ON 		T2.client_id = T3.client_id
		WHERE 	T3.client_id > 0						 
		AND     T1.approval_status IN (0,2) 
		AND     T1.brief IN (0,1)
		AND 	T2.offernet_account_id IN ($offernet_account_id);";
        return $this->execQuery($sql);

        
    }


    public function getUserApprovedCampaigns($user_id, $offernet_account_id)
    {
        $sql = "SELECT DISTINCT (T1.id),
		T3.client_name,
		T1.campaign_name,
		T1.campaign_channels,
		T1.campaign_used,
		T1.campaign_status,
		T1.audit_date
		FROM lg_campaigns AS T1
		INNER
		JOIN lg_campaigns_clients AS T2
		ON T1.id = T2.campaign_id
		INNER
		JOIN plat_clients AS T3
		ON T2.client_id = T3.client_id
		LEFT
		JOIN plat_client_accounts AS T4
		ON T3.client_id = T4.client_id
		LEFT
		JOIN plat_users_accounts AS T5
		ON T4.account_id = T5.account_id
		WHERE T3.client_id > 0
		AND	T5.user_id = $user_id
		AND T2.offernet_account_id IN ($offernet_account_id)
		AND T1.approval_status IN (1,5)
		AND T1.campaign_status = 1;";
        return $this->execQuery($sql);
    }


    public function login($username, $password)
    {

        $hashedPassword = md5($password);
        $result = mysql_query("SELECT * FROM plat_users WHERE username = '$username' AND password = '$hashedPassword' LIMIT 1;");

        if(mysql_num_rows($result) == 1)
        {
            $_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            $_COOKIE['cookname'];
            $_COOKIE['cookpass'];
            session_cache_expire( 20 );
            return true;
        }else{
            return false;
        }
    }


    public function Adminlogin($username, $password)
    {

        $hashedPassword = $password;
        $result = mysql_query("SELECT * FROM plat_users WHERE username = '$username' AND password = '$hashedPassword'");

        if(mysql_num_rows($result) == 1){
            $_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            //$_COOKIE['cookname'];
            //$_COOKIE['cookpass'];
            session_cache_expire( 20 );
            return true;
        }else{
            return false;
        }
    }


    //Log the user out. Destroy the session variables.
    public function logout($user_id) {
        $result = mysql_query("UPDATE plat_users SET logged_in = 0 WHERE user_id = '$user_id'");
        unset($_SESSION['user']);
        unset($_SESSION['login_time']);
        unset($_SESSION['logged_in']);
        session_destroy();
    }


    //Check to see if a email exists.
    //This is called during registration to make sure all emails are unique.
    public function checkfirstnameExists($username) {
        $result = mysql_query("SELECT user_id FROM plat_users WHERE username='$username'");
        if(mysql_num_rows($result) == 0)
        {
            return false;
        }else{
            return true;
        }
    }


    //get a user
    //returns a User object. Takes the users id as an input
    public function get($user_id)
    {
        $db = new DB();
        $result = $db->select('plat_users', "user_id = $user_id");

        return new User($result);
    }


    public function accountActive($username, $password)
    {
        $hashedPassword = md5($password);

        $result =  mysql_query("SELECT * FROM plat_users WHERE username = '$username' AND password = '$hashedPassword' AND active = 1");

        if(mysql_num_rows($result) == 1)
        {
            return true;
        }else{
            return false;
        }
    }


    public function loggedIn($username, $password)
    {
        $ipaddress = $_SERVER["REMOTE_ADDR"];
        $hashedPassword = md5($password);

        $result =  mysql_query("SELECT * FROM plat_users WHERE username = '$username' AND password = '$hashedPassword' LIMIT 1;");

        if(mysql_num_rows($result) == 1)
        {
            $sql = "SELECT * FROM plat_users WHERE username = '$username' AND password = '$hashedPassword'";
            $result = mysql_query($sql) or die(mysql_error());
            while($row = mysql_fetch_array($result)){$user_id = $row["user_id"];}
            $result = mysql_query("INSERT log_logins (user_id,username,password,ip) VALUES ('$user_id','$username','$hashedPassword','$ipaddress')");
            $result = mysql_query("UPDATE plat_users SET logged_in = 1 WHERE user_id = '$user_id'");
            return true;
        }else{
            return true;
        }
    }


    public function incorrectLogin($username, $password)
    {
        $ipaddress = $_SERVER["REMOTE_ADDR"];

        $sql = "INSERT log_incorrect_logins (username,password,ip) VALUES ('$username','$password','$ipaddress')";
        $result = mysql_query($sql) or die(mysql_error());
        return true;
    }


    public function GetAllUserBranchIds($usr_id,$clnt_id){
        $sql = "SELECT branch_id FROM platform.plat_client_branches_users WHERE user_id = $usr_id AND client_id = $clnt_id;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        $Branch_Ids = 0;
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $Branch_Ids.= $row["branch_id"].',';
            }
            $Branch_Ids=substr($Branch_Ids, 0, -1);
            return $Branch_Ids;
        }else{
            return $Branch_Ids;
        }
    }


    public function GetBranchAvailableIndustries($branchid){
        $sql = "SELECT * FROM platform.plat_client_branches WHERE branch_id = $branchid;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        $Induxtry_Ids = '';
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $Induxtry_Ids.= $row["branch_available_industries"].',';
            }
            $Induxtry_Ids=substr($Induxtry_Ids, 0, -1);
            return $Induxtry_Ids;
        }else{
            return $Induxtry_Ids;
        }
    }


    public function GetBranchAvailableCahnnels($branchid){
        $sql = "SELECT * FROM platform.plat_client_branches WHERE branch_id = $branchid;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        $Induxtry_Ids = '';
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $Induxtry_Ids.= $row["branch_available_channel"].',';
            }
            $Induxtry_Ids=substr($Induxtry_Ids, 0, -1);
            return $Induxtry_Ids;
        }else{
            return $Induxtry_Ids;
        }
    }


    public function GetUserClientBranchLatLngFromBranchId($id,$latlng){
        $sql = "SELECT `".$latlng."` AS LatLng FROM platform.plat_client_branches WHERE branch_id = $id;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $LatLng = $row['LatLng'];
            }
        }else{
            $LatLng = 0;
        }
        return $LatLng;
    }


    public function GetUserClientBranchInfoFromId($id,$info){
        $sql = "SELECT `".$info."` AS Info FROM platform.plat_client_branches WHERE branch_id = $id;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $Info = $row['Info'];
            }
        }else{
            $Info = '';
        }
        return $Info;
    }


    public function GetUserClientBranchId($usr_id,$clnt_id){
        $sql = "SELECT * FROM platform.plat_client_branches_users WHERE user_id = $usr_id AND client_id = $clnt_id AND primary_branch = 1;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $branch_id = $row['branch_id'];
            }
        }else{
            $branch_id = 0;
        }
        return $branch_id;
    }


    public function GetUserClientLogo($clnt_id,$branch_id){
        $sql = "SELECT * FROM platform.plat_client_branches WHERE client_id = $clnt_id AND branch_id = $branch_id;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $logo = $row['branch_logo'];
            }
        }else{
            $logo = 'bf-logo.png';
        }
        return $logo;
    }


    public function GetUserClientBranchPricingFromId($client_id,$client_branch_id,$channel,$info){
        $sql = "SELECT `".$info."` AS Info FROM platform.plat_client_branch_pricing WHERE client_id = $client_id AND client_branch_id = $client_branch_id AND channel_id = $channel;";
        $result = mysql_query($sql) or die(mysql_error());
        $num = mysql_num_rows($result);
        if($num>0){
            while($row = mysql_fetch_array($result)){
                $Info = $row['Info'];
            }
        }else{
            $Info = 0;
        }
        return $Info;
    }


    public function getUserLevel($user_id)
    {
        $sql = "SELECT user_level FROM platform.plat_users where user_id=$user_id;";
        return $this->execQuery($sql);
    }


    public function getUserClients($user_id)
    {
        $sql = "select * from platform.plat_users as t1 inner join platform.plat_users_clients_accounts as t2 on t2.client_id=t1.client_id where t1.user_id=$user_id;";
        return $this->execQuery($sql);
    }


}