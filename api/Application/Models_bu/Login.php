<?php

use MVC\Model;

class ModelsLogin extends Model
{

    public function execQuery($sql)
    {
        // exec query
        $query = $this->db->query($sql);
        // Conclusion
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data[$key] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }
        return $data;
    }

    public function userLogin($username)
    {
//        $query = "SELECT * FROM platform.plat_users WHERE username = $username";
        $query = "SELECT * FROM platform.plat_users WHERE username='$username'";
        return $this->execQuery($query);
    }




}