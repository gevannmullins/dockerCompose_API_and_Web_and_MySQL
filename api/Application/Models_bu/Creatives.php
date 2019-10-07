<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreatives extends Model
{
    /**
     * @param $sql
     * @return array
     */
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

    /**
     * @return array
     */
    public function index()
    {
        $sql = "select * from creative_builder.creatives as t1;";
        return $this->execQuery($sql);
    }

    /**
     * @return array
     */
    public function creatives_channels()
    {
        $sql = "select * from creative_builder.channels as t1;";
        return $this->execQuery($sql);
    }

    /**
     * @return array
     */
    public function types()
    {
        $sql = "select * from creative_builder.types as t1;";
        return $this->execQuery($sql);
    }

    /**
     * @return array
     */
    public function getAllCreatives()
    {
        $sql = "select t1.id, t1.creative_name, t1.creative_channel, t1.created_by, t2.channel_name, t1.creative_type, t1.created_at from creative_builder.creatives as t1 inner join creative_builder.channels as t2 on t2.id=t1.creative_channel order by t1.id desc;";
        return $this->execQuery($sql);
    }

    /**
     * @param $creative_id
     * @return array
     */
    public function getCreativeById($creative_id)
    {
        $sql = "select * from creative_builder.creatives as t1 where id=$creative_id;";
        return $this->execQuery($sql);
    }

    /**
     * @param $creative_name
     * @return array
     */
    public function getCreativeByName($creative_name)
    {
        $sql = "select * from creative_builder.creatives as t1 where creative_name='$creative_name';";
        return $this->execQuery($sql);
    }

    /**
     * @param $creative_channel
     * @return array
     */
    public function getCreativesByChannel($creative_channel)
    {
        $sql = "select * from creative_builder.creatives as t1 where creative_channel='$creative_channel';";
        return $this->execQuery($sql);
    }

    /**
     * @param $creative_id
     * @return array
     */
    public function getCreativeAllInfoById($creative_id)
    {
        $sql = "SELECT * FROM creative_builder.creatives as t1 inner join creative_builder.creatives_accounts WHERE t1.id = $creative_id;";
        return $this->execQuery($sql);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function new_creative($data)
    {
        $returnData = [];
        $user_id = $data->user_id;
        $creative_accounts = $data->creative_accounts;
        $channel_id = $data->channel_id;
        $channel_type = $data->chtype;
        $creative_name = $data->creative_name;
        $offernet_account_id = $data->offernet_account_id;
        $creative_id = $data->creative_id;
        $created_at = date("Y-m-d");

        if($creative_id == 0){
            $sql = "insert into creative_builder.creatives (creative_name, user_id, offernet_account_id, creative_channel, creative_type, created_by, created_at) values ('$creative_name', '$user_id', '$offernet_account_id', '$channel_id', '$channel_type', $user_id, '$created_at');";
            $returnData[] = $this->execQuery($sql);
            $creative_id = $this->db->getLastId();
        }else{
            $sql = "update creative_builder.creatives set creative_name = '$creative_name', user_id = '$user_id', offernet_account_id = '$offernet_account_id', creative_channel = '$channel_id', creative_type = '$channel_type', created_by = '$user_id', created_at = '$created_at' where id='$creative_id';";
            $returnData[] = $this->execQuery($sql);
        }
        foreach ($creative_accounts as $ca) {
            $sql = "insert into creative_builder.creatives_accounts (creative_id, account_id) values ('$creative_id', '$ca');";
            $returnData[] = $this->execQuery($sql);
        }
        return $creative_id;

    }

    /**
     * @param $data
     * @return array
     */
    public function update_creative($data)
    {
        $creative_name = $data['creative_name'];
        $creative_id = $data['creative_id'];

        $sql = "update creative_builder.creatives set creative_name = '$creative_name' where id='$creative_id';";
        $returnData[] = $this->execQuery($sql);
//        $this->db = null;
        return $returnData;

    }



}