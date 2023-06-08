<?php

class ConfigModel{

    static public function GetFile($file){

        $jsonData = file_get_contents($file);

        return json_decode($jsonData, true);

    }

    static public function GetDatabases(){

        $databases = ConfigModel::GetFile('config/databases.json');

    }

}

?>