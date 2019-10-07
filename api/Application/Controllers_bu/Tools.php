<?php

use MVC\Controller;

class ControllersTools extends Controller
{

    public function retJson($rawQueryData)
    {
        // Conclusion
        $data = [];
        if ($rawQueryData->num_rows) {
            foreach($rawQueryData->rows as $key => $value):
                $data[$key] = $value;
            endforeach;
        } else {
            $data[] = $rawQueryData->rows;
        }

        return $data;

    }

}

?>