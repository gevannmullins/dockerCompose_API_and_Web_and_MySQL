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


    // Get all the users
    public function getAllUsers()
    {
        // sql statement
        $sql = "SELECT * FROM users AS t1 LEFT JOIN users_info as t2 ON t2.id=t1.id;";
        return $this->execQuery($sql);

    }

    // Get user's details
    private function getUser($user_id)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "users_info WHERE id = '" . $user_id . "'";
        return $this->execQuery($sql);
    }

    private function getUserProducts($user_id)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "user_products WHERE user_id = '" . $user_id . "'";
        return $this->execQuery($sql);
    }




    private function getProductUsers($product_id)
    {
        $sql = "SELECT * FROM " . DB_PREFIX . "user_product WHERE product_id = '" . $product_id . "'";
        return $this->execQuery($sql);
    }



    private function getCountUsers()
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "users");
        return ($query->num_rows > 0) ? (int) $query->row['total'] : 0;
    }



    public function deleteUser($user_id)
    {

        $sql = "DELETE FROM users where id = '$user_id'";    
        return $this->execQuery($sql);

    }    


    public function getUserInfo($user_id)
    {

        $sql = "SELECT * FROM users WHERE id='$user_id'";
        return $this->execQuery($sql);

    }

    public function newUser($username, $password)
    {
        $hashedPassword = md5($password);
        $sql = "INSERT INTO users (username, password) VALUES ('$username','$hashedPassword');";
        $query = $this->db->query($sql);

    }

    public function login($username, $password)
    {

        $hashedPassword = md5($password);
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword' LIMIT 1;";
        $query = $this->db->query($sql);
        $userAuthenticated = ($query->num_rows > 0) ? true : false;

        if ($userAuthenticated) {
            $_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
            $_SESSION["login_time"] = time();
            $_SESSION["logged_in"] = 1;
            $_COOKIE['cookname'];
            $_COOKIE['cookpass'];
            session_cache_expire( 20 );
            return true;
        } else {
            return false;
        }
//
//        if(mysql_num_rows($result) == 1)
//        {
//            $_SESSION["user"] = serialize(new User(mysql_fetch_assoc($result)));
//            $_SESSION["login_time"] = time();
//            $_SESSION["logged_in"] = 1;
//            $_COOKIE['cookname'];
//            $_COOKIE['cookpass'];
//            session_cache_expire( 20 );
//            return true;
//        }else{
//            return false;
//        }
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
    public function checkUsernameExists($username)
    {
        $query = $this->db->query("SELECT COUNT(*) as total FROM " . DB_PREFIX . "users WHERE ");
        return ($query->num_rows > 0) ? true : false;
    }




    public function loggedIn($username, $password)
    {
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










}
