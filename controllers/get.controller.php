<?php

require_once "models/get.model.php";
require_once "sql.controller.php";

class GetController{

    /*
     * No encontrado
     * * * * * * * * * */

    static public function notFound($message){

        $return = new GetController();

        $return -> fncResponse(404, $message);

    }

    /*
     * Peticiones get
     * * * * * * * * * */

     static public function getData($database, $languaje, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount){

        if($languaje == 'sql'){

            $statement = SQLController::query($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount);

        } else {

                
            
        }

        $response = GetModel::getData($statement);

        $status = $response[0];
        $response = $response[1];

        $return = new GetController();

        // return; // Detiene la respuesta para hacer pruebas

        $return -> fncResponse($status, $response);

    }

    /*
     * Respuestas del controlador 
     * * * * * * * * * * * * * * * */

    public function fncResponse($status, $response){

        $count = 0;

        if(is_countable($response)){
            $count = count($response);
        }

        $json = array(
            'status' => $status,
            'size' => $count,
            'results' => $response
        );

        echo json_encode($json, http_response_code($json["status"]));

     }

}

?>