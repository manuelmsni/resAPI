<?php

$_SERVER['REQUEST_URI'];
//explode es como un split
$routesarray = explode("/",$_SERVER['REQUEST_URI']);
//limpia las entradasvacías
$routesarray = array_filter($routesarray);

//imprime el array
//echo '<pre>'; print_r($routesarray); echo '</pre>';

// Si el array está vacío, devuelve not found
if(empty($routesarray)){

    $json = array(
        'status' => 404,
        'result' => 'Not found'
    );
    
    echo json_encode($json, http_response_code($json["status"]));

    return;
}


$json = array(
    'status' => 200,
    'result' => 'success'
);

echo json_encode($json);



?>