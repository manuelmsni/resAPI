<?php

require_once "controllers/get.controller.php";

// Separa los parámetros de la url
$data = explode("?", $routesArray[1]);

// Almacena el valor de la tabla
$table = $data[0];

// Si hay columnas selecionadas las almacena, si no pone *
$select = $_GET["select"] ?? "*";

// Si hay campos que corresponden al WHERE los almacena
$fields = $_GET["field"];
$iss = $_GET["is"];

$response = new GetController();

if(!empty($fields) && !empty($iss)){ // Si hay WHERE

    $response -> getDataWhere($table, $select, $fields, $iss);

} else { // Si no hay WHERE

    $response -> getData($table, $select);

}


?>