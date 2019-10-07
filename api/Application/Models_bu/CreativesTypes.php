<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreativesTypes extends Model
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
        $sql = "select * from creative_builder.types as t1;";
        return $this->execQuery($sql);
    }

    public function getTypesByChannelId($channel_id)
    {
        $sql = "select * from creative_builder.types as t1 where t1.channel_id='$channel_id';";
        return $this->execQuery($sql);
    }


}