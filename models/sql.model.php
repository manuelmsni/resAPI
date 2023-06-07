<?php

class sqlModel{

    static public function query($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount){
        
        $sql = "SELECT $select FROM $table";
        $querry = $sql;
        $limit = "";

        if(!empty($limitBringCount)){
            $limit = " LIMIT ";

            if($limitStartAt != 0){
                $limit.=$limitStartAt.", ";
            }

            $limit.= $limitBringCount;
        }

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

                $querry .= " ORDER BY $order".$limit;

                return array(404, $querry, '');

            }

            $orderConpounds = explode($separator, $order);
                
            $orderBy = $orderConpounds[0];
            $direction = $orderConpounds[1];

            $sql .= " ORDER BY $orderBy $direction".$limit;
            $querry .= " ORDER BY $orderBy $direction".$limit;

            // Si no cumple el formato y tiene separador debo salir
            if(!$orderFormat && $hasSeparator){
                return array(404, $querry, '');
            }

             echo $sql;
             return; // Detiene la respuesta para hacer pruebas

            $statement = Connection::connect($database) -> prepare($sql);

            if($replace){

                foreach ($dictionary as $key => $value) {

                    $statement -> bindParam(":".$key, $value, PDO::PARAM_STR);
                    
                }

            }

            return $statement;

        }

        
    }

}

?>