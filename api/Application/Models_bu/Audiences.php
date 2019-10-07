<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsAudiences extends Model
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

        return $data;

    }


    /** Checks if an audience exists, returns true if audience exists
     * @param $audience_id
     * @return bool
     */
    public function audience_exist($audience_id)
    {
        $sql = "EXISTS(SELECT * from platform_audiences.plat_audiences WHERE id='$audience_id');";
        $exists = $this->execQuery($sql);
        if ($exists === 1) {
            return true;
        } else {
            return false;
        }
    }


    /** Returns an array of all
     * @return array
     */
    public function index()
    {
        $sql = "select * from platform_audiences.plat_audiences as t1;";
        return $this->execQuery($sql);
    }

    public function get_audience_by_id($audience_id)
    {
        $sql = "select * from platform_audiences.plat_audiences as t1 where t1.id='$audience_id';";
        return $this->execQuery($sql);
    }

    public function get_audience_accounts($audience_id)
    {
        $sql = "select * from platform_audiences.plat_audiences_accounts as t1 where t1.audience_id='$audience_id';";
        return $this->execQuery($sql);
    }




}