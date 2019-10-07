<?php

use MVC\Model;

class ModelsReports extends Model
{
    public function runQuery($sql)
    {
        // exec query
        $query = $this->db->query($sql);

        $data = [];

        // Conclusion
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data[$key][] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }

        return $data;

    }



    public function reports()
    {

        // sql statement
        $sql = "SELECT * FROM " . DB_PREFIX . "plat_users";

        // exec query
        $query = $this->db->query($sql);

        $data = [];

        // Conclusion
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data[$key][] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }

        return $data;


    }



}