<?php

    /*
     * Mostrar errores  
     * * * * * * * * * */

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('error_log', "C:/xampp/htdocs/resAPI/php_error_log.txt");

    /*
     * Requerimientos  
     * * * * * * * * * */

    require_once 'models/connection.php';

    require_once 'controllers/routes.controller.php';

/*
    require_once 'controllers/source.controller.php';
    $ip = SourceController::getRealIP();
    $user =  $_GET["user"] ?? "";
    $password =  $_GET["password"] ?? "";
    $session =  $_GET["session"] ?? "";
*/
    $index= new RoutesController();

    $index -> index();

    //https://www.youtube.com/watch?v=RCxFHxISFvc

?>