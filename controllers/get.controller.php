<?php

require_once "models/get.model.php";

class GetController{

    /*
     * No encontrado
     * * * * * * * * * */

    static public function notFound($message){

        $return = new GetController();

        $return -> fncResponse(404, '', $message);

    }

    /*
     * Peticiones get
     * * * * * * * * * */

     static public function getData($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount){

        $response = GetModel::getData($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount);

        $status = $response[0];
        $querry = $response[1];
        $response = $response[2];

        $return = new GetController();

        // return; // Detiene la respuesta para hacer pruebas

        $return -> fncResponse($status, $querry, $response);

    }

    /*
     * Respuestas del controlador 
     * * * * * * * * * * * * * * * */

     public function fncResponse($status, $querry, $response){

        $count = 0;

        if(is_countable($response)){
            $count = count($response);
        }

        $json = array(
            'status' => $status,
            'size' => $count,
            'querry' => $querry, // COMENTAR EN PRODUCCIÓN // Solo para testear
            'results' => $response
        );

        echo json_encode($json, http_response_code($json["status"]));

     }

}

?>