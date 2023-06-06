<?php

require_once "connection.php";

class GetModel{

    static public function getData($table){

        $sql = "SELECT * FROM $table";

        $statment = Connection::connect() -> prepare($sql);

        $statment -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        return $statment -> fetchAll(PDO::FETCH_CLASS);

    }

}

?>