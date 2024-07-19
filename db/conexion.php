<?php

function conexion() {
     try {
         $base = new PDO('mysql:host=localhost;dbname=c2082289_sch', 'c2082289_sch', 'pilavaBU97');
         $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         return $base;
     } catch (PDOException $e) {
         echo 'Error de conexión: 1' . $e->getMessage() ;
         return null;
     }
 };






 