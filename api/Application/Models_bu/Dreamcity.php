<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsDreamcity extends Model
{

    /** Used to convert data into a JsonObject
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

        return $query;

    }

    public function save_info($data)
    {
        $returnData = [];
        $last_id = [];
        $code = $data->code;
        $sql = "insert into dreamcity.dreamcity_entries (code, audit_date) values ('$code', '01-01-01');";

        $dbEntry = $this->execQuery($sql);
        $dreamcity_id = $dbEntry->last_id;
        if ($dreamcity_id == ''  || $dreamcity_id == 0 || $dreamcity_id == "0" || $dreamcity_id == null) {
            return false;
        }
        $returnData['last_entered_id'] = $dreamcity_id;
        $last_id['last_entered_id'] = $dreamcity_id;

        foreach($data as $key=>$value){
            $sql2 = "insert into dreamcity.dreamcity_codes (data_key, data_value, dreamcity_id) values ('$key', '$value', '$dreamcity_id');";
            $returnData[] = $this->execQuery($sql2);
            $dreamcity_entry_id = $dbEntry->last_id;
            if ($dreamcity_entry_id == ''  || $dreamcity_entry_id == 0 || $dreamcity_entry_id == "0" || $dreamcity_entry_id == null) {
                return false;
            }

        }

        return $last_id;

    }




}