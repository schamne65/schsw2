<?php

function conexion() {
     try {
         $base = new PDO('mysql:host=localhost;dbname=inventario', 'root', 'mysql');
         $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $base;
     } catch (PDOException $e) {
         echo 'Error de conexión: 1' . $e->getMessage() ;
         return null;
     }
 };


session_start();

function checkLogin() {
    if (!isset($_SESSION['username'])) {
        header('Location: ../usuario/login.php');
        exit();
    }
}
?>


 