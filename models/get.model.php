<?php

require_once "connection.php";

class GetModel{

    /*
     * Peticiones get con WHERE (field, is)
     * * * * * * * * * * * * * * * * * * * */

     static public function getData($table, $select, $field, $is, $order){

        $sql = "SELECT $select FROM $table";
        $querry = $sql;

        $separator = "***";
        $escapedSeparator = preg_quote($separator, '/');

        $cFs = 0;
        $cIs = 0;

        if (!empty($field)) {
            $fields = explode($separator, $field);
            $cFs = count($fields);
        }

        if (!empty($is)) {
            $iss = explode($separator, $is);
            $cIs = count($iss);
        }

        $where = '';
        $whereQuerry = '';
        $replace = false;

        if($cFs > 0 && $cFs == $cIs){

            $replace = true;

            $dictionary = array_combine($fields, $iss);

            foreach ($dictionary as $key => $value) {

                if (!empty($where)) {
                    $where .= " AND ";
                    $whereQuerry .= " AND ";
                }
        
                $where .= $key." = :".$key;
                $whereQuerry .= $key." = ".$value;

            }

            if (!empty($where)) {

                $sql .= " WHERE $where";
                $querry .= " WHERE $whereQuerry";
            }

        }


        if(!empty($order)) { 
            // Comprueba si acaba en ASC o DESC, descartando a su vez si está vacío
            $orderFormat = preg_match('/'.$escapedSeparator.'ASC$/', $order) || preg_match('/'.$escapedSeparator.'DESC$/', $order);
            $hasSeparator = preg_match('/'.$escapedSeparator.'/', $order);

            // Si no cumple el formato y no contiene separador
            if (!$orderFormat && !$hasSeparator) {

                $querry .= " ORDER BY $order";

                return array('', $querry);

            }

            $orderConpounds = explode($separator, $order);
                
            $orderBy = $orderConpounds[0];
            $direction = $orderConpounds[1];

            $sql .= " ORDER BY $orderBy $direction";
            $querry .= " ORDER BY $orderBy $direction";

            // Si no cumple el formato y tiene separador debo salir
            if(!$orderFormat && $hasSeparator){
                return array('', $querry);
            }

        }

        // echo $sql;
        // return; // Detiene la respuesta para hacer pruebas

        $statement = Connection::connect() -> prepare($sql);

        if($replace){

            foreach ($dictionary as $key => $value) {

                $statement -> bindParam(":".$key, $value, PDO::PARAM_STR);
                
            }

        }

        $statement -> execute();

        // Pasando por parámetros PDO::FETCH_CLASS limpio la información de salida para que en esta no se incluyan los indices
        $result = $statement -> fetchAll(PDO::FETCH_CLASS);

        return array($result, $sql);

    }

}

?>