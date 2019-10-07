<?php

use MVC\Model;

class ModelsDbqueries extends Model
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

    public function runQuery($query)
    {
//        return "queryModel";
//        $sql = "select t1.title, t1.names, t1.surname, t2.celltelno, t3.email_address, t4.region, t4.suburb from bastion.cons_consumer_info as t1 inner join bastion.log_celltelno as t2 on t2.consumer_id=t1.consumer_id inner join bastion.log_email_address as t3 on t3.consumer_id=t1.consumer_id inner join platform.target_lookup as t4 on t4.consumer_id=t1.consumer_id where t1.consumer_id<>0 and (t4.age between 18 and 71) and t4.home_owners=1";
        return $this->execQuery("select * from platform.target_lookup limit 5");
//        return $this->execQuery("select t1.title, t1.names, t1.surname, t2.celltelno, t3.email_address, t4.region, t4.suburb from bastion.cons_consumer_info as t1 inner join bastion.log_celltelno as t2 on t2.consumer_id=t1.consumer_id inner join bastion.log_email_address as t3 on t3.consumer_id=t1.consumer_id inner join platform.target_lookup as t4 on t4.consumer_id=t1.consumer_id where t1.consumer_id<>0 and (t4.age between 18 and 71) and t4.home_owners=1");
    }

    public function queryModel()
    {
        $sql1 = "select * from platform.target_lookup limit 5";
//        $sql = "select t1.title, t1.names, t1.surname, t2.celltelno, t3.email_address, t4.region, t4.suburb from bastion.cons_consumer_info as t1 inner join bastion.log_celltelno as t2 on t2.consumer_id=t1.consumer_id inner join bastion.log_email_address as t3 on t3.consumer_id=t1.consumer_id inner join platform.target_lookup as t4 on t4.consumer_id=t1.consumer_id where t1.consumer_id<>0 and (t4.age between 18 and 71) and t4.home_owners=1";
        return $this->execQuery($sql1);
    }




}