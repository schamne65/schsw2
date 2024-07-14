<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_icon.css">
    
</head>
<body>

<?php

     include '../comunes/nav.php';?>
<section>

<?php
  include '../db/conexion.php';
 $conexiones = conexion();
 
 if ($conexiones) {
     $consulta = "SELECT * FROM proveedores";
     try {
         $stmt = $conexiones->query($consulta);
         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
         if ($resultado) {
             foreach ($resultado as $row) {
                 $id = $row['proveedores_id'];
                 $nombre = $row['proveedores_nombre'];
                 $direccion = $row['proveedores_direccion'];
                 $telefono = $row['proveedores_telefono'];
                 
                 echo "ID: $id<br>";
                 echo "Nombre: $nombre<br>";
                 echo "Dirección: $direccion<br>";
                 echo "Teléfono: $telefono<br><br>";
             }
         } else {
             echo "No se encontraron datos en la tabla inventario. 2";
         }
     } catch (PDOException $e) {
         echo 'Error en la consulta: 3' . $e->getMessage() ;
     }
 } else {
     echo 'No se pudo establecer la conexión a la base de datos.4';
 }?>
 </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
 <script src="../js/script.js"></script>
 </body>
 </html>
