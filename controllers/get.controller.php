<?php

require_once "models/get.model.php";

class GetController{

    /*
     * Peticiones get sin WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

    static public function getData($table, $select){

        $response = GetModel::getData($table, $select);

        $return = new GetController();

        $return -> fncResponse($response);

    }

    /*
     * Peticiones get con WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

     static public function getDataWhere($table, $select, $field, $is){

        $response = GetModel::getDataWhere($table, $select, $field, $is);

        $return = new GetController();

        //return;

        $return -> fncResponse($response);

    }

    /*
     * Respuestas del controlador 
     * * * * * * * * * * * * * * * */

     public function fncResponse($response){

        if(!empty($response)){

            $json = array(
                'status' => 200,
                'size' => count($response),
                'results' => $response
            );

        } else {

            $json = array(
                'status' => 404,
                'results' => 'Not Found'
            );

        }

        echo json_encode($json, http_response_code($json["status"]));

     }

}

?>