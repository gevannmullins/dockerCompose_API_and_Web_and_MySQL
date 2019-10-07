<?php

/**
 *
 * This file is part of mvc-rest-api for PHP.
 *
 */
namespace MVC;

/**
 * Class Model, a port of MVC
 *
 * @author Mohammad Rahmani <rto1680@gmail.com>
 *
 * @package MVC
 */
class Model {

    /**
     * @var
     */
    public $db;
    public $pagination;
    public $headers;

    /**
     *  Construct
     */
    public function __construct() {
        $this->db = new \Database\DatabaseAdapter(
            DATABASE['Driver'],
            DATABASE['Host'],
            DATABASE['User'],
            DATABASE['Pass'],
            DATABASE['Name'],
            DATABASE['Port']    
        );

        $this->pagination = $GLOBALS['pagination'];
//        $this->headers =
    }

    public function execQuery($sql)
    {
        // exec query
        $query = $this->db->query($sql);
        $lastId = $this->db->getLastId();

        // Conclusion
        $data = [];
        if ($query->num_rows) {
            foreach($query->rows as $key => $value):
                $data[$key] = $value;
            endforeach;
        } else {
            $data[] = $query->rows;
        }

        $data['last_id'] = $lastId;
        $this->db = null;
        return $data;

    }


}
