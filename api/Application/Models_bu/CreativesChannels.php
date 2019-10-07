<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreativesChannels extends Model
{


    public function execQuery($sql)
    {
        // exec query
        $query = $this->db->query($sql);

        // Conclusion
        $data = [];
        if ($query->num_rows) {
            foreach ($query->rows as $key => $value):
                $data[$key] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }

        return $data;

    }

    public function index()
    {
        $sql = "select * from creative_builder.channels as t1;";
        return $this->execQuery($sql);
    }

    public function creatives_channels()
    {
        $sql = "select * from creative_builder.channels as t1;";
        return $this->execQuery($sql);
    }

}
