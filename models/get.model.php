<?php

require_once "connection.php";

class GetModel{

    /*
     * Peticiones get sin WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

    static public function getData($table, $select){

        $sql = "SELECT $select FROM $table";

        $statment = Connection::connect() -> prepare($sql);

        $statment -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        return $statment -> fetchAll(PDO::FETCH_CLASS);

    }

    /*
     * Peticiones get con WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

     static public function getDataWhere($table, $select, $field, $is){

        $fields = explode("·S·", $field);
        $cFs = count($fields);

        $iss = explode("·S·", $is);
        $cIs = count($iss);

        $where = '';

        if($cFs > 0 && $cFs == $cIs){

            $dictionary = array_combine($fields, $iss);

            foreach ($dictionary as $key => $value) {

                if (!empty($where)) {
                    $where .= " AND ";
                }
        
                $where .= $key." = :".$key;

            }

        }

        // No se puede concatenar en la declaración de la sentencia SQL
        $sql = "SELECT $select FROM $table";

        if (!empty($where)) {

            $sql .= " WHERE $where";

        }

        //echo $sql;
        //return;

        $statement = Connection::connect() -> prepare($sql);

        if($cFs > 0 && $cFs == $cIs){

            foreach ($dictionary as $key => $value) {

                $statement -> bindParam(":".$key, $value, PDO::PARAM_STR);
                
            }

        }

        $statement -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        return $statement -> fetchAll(PDO::FETCH_CLASS);

    }

}

?>