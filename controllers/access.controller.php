<?php

require_once "models/access.model.php";

class AccessController{

    public function startSession(){

        $session = AccessModel::startSession();

    }

}

?>