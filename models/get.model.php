<?php

require_once "connection.php";

require_once "sql.model.php";

class GetModel{

    /*
     * Peticiones get con WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

     static public function getData($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount){

        $queryLanguage = "SQL"; // Buscar en la configuración

        if($queryLanguage == "SQL"){

            $statement = sqlModel::query($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount);

        }

        $statement -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        $result = $statement -> fetchAll(PDO::FETCH_CLASS);

        return array(200, $result);

    }

}

?>