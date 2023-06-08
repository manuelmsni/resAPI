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

    require_once 'controllers/access.controller.php';

    $access = new AccessController();

    $access -> startSession();

    

    $index= new RoutesController();

    $index -> index();

    //https://www.youtube.com/watch?v=RCxFHxISFvc

?>