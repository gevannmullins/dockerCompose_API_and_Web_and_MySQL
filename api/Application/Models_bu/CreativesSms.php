<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreativesSms extends Model
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

    public function index()
    {
        $sql = "select t1.client_id, t1.client_name,t2.account_id,t2.account_name from platform.plat_clients as t1 inner join platform.plat_client_accounts as t2 on t2.client_id=t1.client_id";
        return $this->execQuery($sql);

    }

    public function saveSmsCreative($data)
    {
        $creative_id = $data->creative_id;
        $sms_content = $data->sms_content;
        $created_at = date("Y-m-d");
        $sql = "INSERT into creative_builder.sms_creatives (sms_content, creative_id, created_at) values ('$sms_content','$creative_id', '$created_at')";
        return $this->execQuery($sql);
    }


}