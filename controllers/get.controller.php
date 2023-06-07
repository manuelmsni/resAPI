<?php

require_once "models/get.model.php";

class GetController{

    /*
     * No encontrado
     * * * * * * * * * */

     static public function notFound(){

        $return = new GetController();

        $return -> fncResponse('', '');

     }

    /*
     * Peticiones get
     * * * * * * * * * */

     static public function getData($table, $select, $field, $is, $order){

        $response = GetModel::getData($table, $select, $field, $is, $order);

        $querry = $response[1];
        $response = $response[0];

        $return = new GetController();

        // return; // Detiene la respuesta para hacer pruebas

        $return -> fncResponse($response, $querry);

    }

    /*
     * Respuestas del controlador 
     * * * * * * * * * * * * * * * */

     public function fncResponse($response, $querry){

        if(!empty($response)){

            $json = array(
                'status' => 200,
                'size' => count($response),
                'querry' => $querry,
                'results' => $response
            );

        } else {

            $json = array(
                'status' => 404,
                'querry' => $querry,
                'results' => 'Not Found'
            );

        }

        echo json_encode($json, http_response_code($json["status"]));

     }

}

?>