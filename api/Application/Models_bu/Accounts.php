<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsAccounts extends Model
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

    public function index2()
    {

//        $sql = "SELECT * FROM plat_client_accounts";
        $sql = "select * from platform.plat_clients as t1 inner join platform.plat_client_accounts as t2 ON t2.client_id=t1.client_id inner join platform.plat_users_accounts as t3 on t3.account_id=t2.account_id;";
//        $sql = "SELECT * FROM platform.plat_users AS T1 INNER JOIN platform.plat_users_accounts AS T2 ON T1.user_id = T2.user_id WHERE T2.account_id = $account_id;"; // gets user status of account
//        $sql = "SELECT * FROM platform.plat_users AS T1 INNER JOIN platform.plat_users_accounts AS T2 ON T1.user_id = T2.user_id WHERE T2.user_id = $user_id;"; // gets user status of account


        return $this->execQuery($sql);

    }

    public function index($user_id)
    {

//        $sql = "SELECT * FROM plat_client_accounts";
//        $sql = "select * from platform.plat_clients as t1 inner join platform.plat_client_accounts as t2 inner join platform.plat_users_accounts as t3 on t3. on t2.client_id=t1.client_id";
//        $sql = "SELECT * FROM platform.plat_users AS T1 INNER JOIN platform.plat_users_accounts AS T2 ON T1.user_id = T2.user_id WHERE T2.account_id = $account_id;"; // gets user status of account
        $sql = "SELECT * FROM platform.plat_users_accounts AS t1 INNER JOIN platform.plat_client_accounts AS t2 ON t2.account_id=t1.account_id INNER JOIN platform.plat_clients AS t3 ON t3.client_id=t2.client_id WHERE t1.user_id='$user_id';"; // gets user status of account


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
        $sql = "SELECT * FROM platform.plat_client_accounts WHERE account_id=$account_id;";
        return $this->execQuery($sql);
    }

    public function get_clients()
    {
        $sql = "SELECT * FROM platform.plat_clients;";
        return $this->execQuery($sql);
    }

    public function get_accounts()
    {
        $sql = "SELECT * FROM platform.plat_client_accounts;";
        return $this->execQuery($sql);
    }

    public function get_accounts_by_client_id($client_id)
    {
        $sql = "SELECT * FROM platform.plat_client_accounts where client_id='$client_id';";
        return $this->execQuery($sql);
    }


    public function get_clients_accounts()
    {
        $returnData = [];
        $clients = $this->get_clients();
        foreach($clients as $client){
            $client_id = $client['client_id'];
            $client_name = $client['client_name'];
            $accounts = $this->get_accounts_by_client_id($client_id);
            $returnData[] = [
                "groupName"=>$client_name,
                "groupData"=>$accounts[0]
            ];

        }


        return $returnData;

    }



}