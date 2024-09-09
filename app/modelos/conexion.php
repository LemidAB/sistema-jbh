<?php

Class Conexion{
    static public function conectar(){
        $host = 'db-jbh'; // Nombre del servicio de la base de datos en Docker Compose
        $dbname = 'jbh_bd'; // Nombre de la base de datos definida en Docker Compose
        $user = 'root'; // Nombre de usuario definido en Docker Compose
        $password = 'test'; // Contraseña definida en Docker Compose

        try {
            $link = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

            $link->exec("set names utf8");

            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $link;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            return null;
        }
    }
}