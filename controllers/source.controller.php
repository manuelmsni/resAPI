<?php

require_once "models/get.model.php";

class SourceController{

    static public function getRealIP(){

        $return = new SourceModel();
        
        return $return -> getRealIP();

    }
}

?>