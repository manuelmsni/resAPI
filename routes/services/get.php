<?php

require_once "controllers/get.controller.php";

// Separa los parámetros de la url
$data = explode("?", $routesArray[1]);

// Almacena el valor de la tabla
$table = $data[0];

// Si hay columnas selecionadas las almacena, si no pone *
$select = $_GET["select"] ?? "*";

// Si hay campos que corresponden al WHERE los almacena
$fields = $_GET["field"] ?? "";
$iss = $_GET["is"] ?? "";

$order = $_GET["order"] ?? "";

$response = new GetController();

try{

    // Si hay errores de sintaxis
    if((!empty($fields) && empty($iss)) || (empty($fields) && !empty($iss))){

        $response -> notFound();

    } else { // Si no hay errores de sintaxis

        $response -> getData($table, $select, $fields, $iss, $order);

    }

} catch(PDOException $e){

    die("Error: ".$e->getMessage());

}


?>