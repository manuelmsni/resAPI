<?php

class AccessModel{

    static public function startSession(){

        // Iniciar la sesión
        session_start();

        // Establecer el tiempo de vida de la cookie de sesión a 1 hora
        $tiempoCaducidad = 3600; // 1 hora en segundos
        session_set_cookie_params($tiempoCaducidad);

        // Verificar si el usuario tiene una sesión válida
        if (!isset($_SESSION['usuario'])) {
            // Redirigir al usuario a la página de login
            header('Location: login.php');
            exit(); // Terminar el script después de redirigir
        }

        // Obtener la IP del cliente
        $ipCliente = $_SERVER['REMOTE_ADDR'];
        
        // Obtener el usuario de la sesión
        $usuario = $_SESSION['usuario'];

    }

}


?>