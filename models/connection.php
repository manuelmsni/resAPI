<?php

class Connection{
    
    /*
     * Información de la base de datos
     * * * * * * * * * * * * * * * * * */

    static public function infoDatabase() {

        $infoDB = array(

            "user" => "root",
            "pass" => ""

        );

        return $infoDB;
    }

    /*
     * Conexión a la base de datos
     * * * * * * * * * * * * * * * * */

    static public function connect($database){

        try{

            $infoDB = Connection::infoDatabase();

            $link = new PDO(
                "mysql:host=localhost;dbname=".$database,
                $infoDB["user"],
                $infoDB["pass"]
            );

            $link->exec("set names utf8");

        } catch(PDOException $e){

            die("Error: ".$e->getMessage());

        }

        return $link;

    }



}
