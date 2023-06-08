<?php

$_SERVER['REQUEST_URI'];

//explode es como un split
$routesArray = explode("/",$_SERVER['REQUEST_URI']);

//limpia las entradasvacías
$routesArray = array_filter($routesArray);

//imprime el array
//echo '<pre>'; print_r($routesarray); echo '</pre>';

// Si el array está vacío, devuelve not found (cuando no se hace ninguna petición a la api)
if(empty($routesArray)){

    $json = array(
        'status' => 404,
        'result' => 'Access denied'
    );
    
    echo json_encode($json, http_response_code($json["status"]));

    return;
}

// Separa los parámetros de la url
$data = explode("?", $routesArray[1]);

// Almacena el comando / nombre de la base de datos
$command = $data[0];

/*

if ($command == 'config'){

} else if ($command == ''){

}

$databases = '';

$database = $databases[$command];

if(!empty($database)){

}

*/

// Averigua si es una petición GET / POST / PUT / DELETE
$method = $_SERVER['REQUEST_METHOD'];

// Comprueba si existe un método http
if(isset($method)){

    // Comprueba si hay un solo parámetro
    if(count($routesArray) == 1){ 

        // Comprueba el tipo de método
        if($method == "GET"){

           include "services/get.php";

           return;

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