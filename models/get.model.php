<?php

require_once "connection.php";

class GetModel{

    /*
     * Peticiones get con WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

     static public function getData($statement){

        $statement -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        $result = $statement -> fetchAll(PDO::FETCH_CLASS);

        return array(200, $result);

    }

}

?>