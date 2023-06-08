<?php

class Connection{

    /*
     * Conexión a la base de datos
     * * * * * * * * * * * * * * * * */

    static public function connect($host, $database, $user, $password){

        try{

            $link = new PDO(
                "mysql:host=".$host.";dbname=".$database,
                $user,
                $password
            );

            $link->exec("set names utf8");

        } catch(PDOException $e){

            die("Error: ".$e->getMessage());

        }

        return $link;

    }



}
