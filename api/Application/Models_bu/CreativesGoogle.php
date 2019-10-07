<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreativesGoogle extends Model
{


    public function execQuery($sql)
    {
        $start_time = round(microtime(true) * 1000);

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
        $end_time = round(microtime(true) * 1000);

        $data['execution_time'] = $end_time - $start_time;

        return $data;

    }

    public function index()
    {

//        $sql = "SELECT * FROM plat_client_accounts";
        $sql = "select t1.client_id, t1.client_name,t2.account_id,t2.account_name from platform.plat_clients as t1 inner join platform.plat_client_accounts as t2 on t2.client_id=t1.client_id";

        return $this->execQuery($sql);

    }

    public function allAccounts()
    {
        $sql = "SELECT * FROM plat_client_accounts";
        return $this->execQuery($sql);
    }

    public function getAccountById()
    {
        // code
    }


    public function accounts()
    {

        // sql statement
        $sql = "SELECT * FROM " . DB_PREFIX . "plat_users";
        return $this->execQuery($sql);


    }


    public function getAccountInfo($account_id)
    {
        $sql = "SELECT * FROM plat_client_accounts WHERE account_id=$account_id";
        return $this->execQuery($sql);
    }


}