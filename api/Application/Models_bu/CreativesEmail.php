<?php


use MVC\Model;
//use BF\Controllers\Tools;


class ModelsCreativesEmail extends Model
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
        $sql = "select * from creative_builder.email_creatives";
        return $this->execQuery($sql);

    }


    public function saveEmailCreative($data)
    {
        $creative_id = $data->creative_id;
        $email_subject = $data->email_subject;
        $email_reply_to = $data->email_reply_to;
        $email_from_display = $data->email_from_display;
        $email_content = $data->email_content;
        $created_at = date("Y-m-d");
        $sql = "INSERT into creative_builder.email_creatives (email_subject, email_reply_to, email_from_display, email_content, creative_id, created_at) values ('$email_subject', '$email_reply_to', '$email_from_display', '$email_content','$creative_id', '$created_at')";
        return $this->execQuery($sql);
//        return $data;
    }



}