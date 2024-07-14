<?php
include "../../db/conexion.php";
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    error_log("Producto ID recibido: " . $producto_id);
    $base = conexion();

    $sql = "SELECT producto_nombre FROM producto WHERE producto_id = :producto_id";
    $stmt = $base->prepare($sql);
    $stmt->bindParam(':producto_id', $producto_id, PDO::PARAM_INT);
    $stmt->execute();
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($producto) {
        error_log("Producto encontrado: " . $producto['producto_nombre']);
        echo $producto['producto_nombre'];
    } else {
        error_log("Producto no encontrado para ID: " . $producto_id);
        echo 'Producto no encontrado';
    }
}


   if (isset($_POST['insumo_id'])) {
            $insumo_id = $_POST['insumo_id'];
            error_log("Producto ID recibido: " . $insumo_id);
            $base = conexion();
        
            $sql = "SELECT insumo_nombre FROM insumo WHERE insumo_id = :insumo_id";
            $stmt = $base->prepare($sql);
            $stmt->bindParam(':insumo_id', $insumo_id, PDO::PARAM_INT);
            $stmt->execute();
            $insumo = $stmt->fetch(PDO::FETCH_ASSOC);
           
            if ($insumo) {
                error_log("Producto encontrado: " . $insumo['insumo_nombre']);
                echo $insumo['insumo_nombre'];
            } else {
                error_log("Producto no encontrado para ID: " . $insumo_id);
                echo 'Producto no encontrado';
            }
        }
 
