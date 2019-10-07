<?php 

use MVC\Model;

class ModelsBilling extends Model {


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

    public function save_test($user_id) {


//        $sql = "SELECT * FROM plat_client_accounts";
        $sql = "select * from platform.plat_users where user_id=$user_id";
        return $this->execQuery($sql);


    }

}
