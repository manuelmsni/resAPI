<?php

$_SERVER['REQUEST_URI'];
//explode es como un split
$routesarray = explode("/",$_SERVER['REQUEST_URI']);
//limpia las entradasvacías
$routesarray = array_filter($routesarray);

//imprime el array
//echo '<pre>'; print_r($routesarray); echo '</pre>';

// Si el array está vacío, devuelve not found (cuando no se hace ninguna petición a la api)
if(empty($routesarray)){

    $json = array(
        'status' => 404,
        'result' => 'Not found'
    );
    
    echo json_encode($json, http_response_code($json["status"]));

    return;
}

// Averigua si es una petición GET / POST / PUT / DELETE
$method = $_SERVER['REQUEST_METHOD'];

// Comprueba si existe un método http
if(isset($method)){

    // Comprueba si hay un solo parámetro
    if(count($routesarray) == 1){ 

        // Comprueba el tipo de método
        if($method == "GET"){

            $json = array(
                'status' => 200,
                'result' => 'Solicitud GET'
            );

        } elseif($method == "POST"){

            $json = array(
                'status' => 200,
                'result' => 'Solicitud POST'
            );

        } elseif($method == "PUT"){

            $json = array(
                'status' => 200,
                'result' => 'Solicitud PUT'
            );

        } elseif($method == "DELETE"){

            $json = array(
                'status' => 200,
                'result' => 'Solicitud DELETE'
            );

        } else {

            return;

        }

        echo json_encode($json, http_response_code($json["status"]));

    }

}

return;

?>