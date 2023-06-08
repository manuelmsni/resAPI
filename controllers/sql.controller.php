<?php

require_once "models/sql.model.php";

class SQLController{

    static public function query($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount){

        $statement = SQLModel::query($database, $table, $select, $field, $is, $order, $limitStartAt, $limitBringCount);

        return $statement;

    }

}

?>