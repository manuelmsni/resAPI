<?php

require_once "controllers/get.controller.php";

$response = new GetController();


$hasAccess = true; // Implementar un método que compruebe si el usuario tiene permisos para la consulta
if(!$hasAccess){

    $response -> notFound("Access denied");

    return;
    
}

// Separa los parámetros de la url
$data = explode("?", $routesArray[1]);

// Almacena el nombre de la base de datos
$database = $data[0];

// Almacena el valor de la tabla
$table = $_GET["table"] ?? "";

// Si no he detectado una tabla seleccionada salgo del programa y devuelvo not found
if(empty($table)){

    $response -> notFound("Access denied");

    return;

}

// Si hay columnas selecionadas, las almacena, si no pone *
$select = $_GET["select"] ?? "*";

// Si hay campos que corresponden al WHERE, los almacena
$fields = $_GET["field"] ?? "";
$iss = $_GET["is"] ?? "";

// Si hay campos que corresponden al ORDER BY, los almacena
$order = $_GET["order"] ?? "";

// Si hay campos que corresponden al LIMIT, los almacena
$limitStartAt = $_GET["start"] ?? 0; // Indice en el cual empieza a contar
$limitBringCount = $_GET["bring"] ?? ""; // Número de entradas que devuelve a partir del indice de comienzo

try{

    // Si hay errores de sintaxis
    if((!empty($fields) && empty($iss)) || (empty($fields) && !empty($iss))){

        $response -> notFound("Access denied");

    } else { // Si no hay errores de sintaxis

        $response -> getData($database, $table, $select, $fields, $iss, $order, $limitStartAt, $limitBringCount);

    }

} catch(PDOException $e){

    $response -> notFound("Access denied");
    //die("Error: ".$e->getMessage());

}


?>