<?php
include "../../db/conexion.php";

function insertarProducto($nombre_producto,$producto_id,$insumo_ids,$cantidad_usada,$stock_min,$deposito) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO producto (producto_id,producto_nombre,stock_min,deposito_nombre) VALUES ( ?, ?, ?, ?)";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$producto_id,$nombre_producto,$stock_min,$deposito]);

        //foreach ($insumo_ids as $insumo_id) {
            if (count($insumo_ids) == count($cantidad_usada)) {
                foreach ($insumo_ids as $index => $insumo_id) {
                    $cantidad_usadas = $cantidad_usada[$index];
                   
        $consulta2 = "INSERT INTO producto_insumo (producto_id,insumo_id,cantidad) VALUES ( ?, ?, ?)";
        $stmt2 = $base->prepare($consulta2);
        $stmt2->execute([$producto_id,$insumo_id,$cantidad_usadas]);
        
      }
    }  
        return true;
        echo $cantidad_usadas;
        var_dump($insumo_nombres);
    } catch (PDOException $e) {
        echo 'aca Error al insertar producto: ' . $e->getMessage();
        return false;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['tipo'] == 'producto') {
   // Obtener los datos del formulario
    $nombre_producto = $_POST['nombre_producto'];
    $producto_id = $_POST['producto_id'];
    $stock_min = $_POST['stock_min'];
    $deposito = $_POST['deposito_nombre'];

    $insumo_ids = array();
$cantidad_usada = array();

$i = 0;

while (isset($_POST["insumo_id_$i"]) && isset($_POST["insumo_cantidad_usada_$i"])) {
    $insumo_ids[] = $_POST["insumo_id_$i"];
    $cantidad_usada[] = $_POST["insumo_cantidad_usada_$i"];
    
    $i++;
}



    // Insertar el proveedor en la base de datos
    if (insertarProducto($nombre_producto,$producto_id,$insumo_ids,$cantidad_usada,$stock_min,$deposito )) {
        echo "producto insertado correctamente.";

        } else {
        echo "Error al insertar producto. aca eesta ele error";
    }
}
}
 


 function sumarProducto($producto_nombre,$cantidad_agregada,$fecha) {
    try {
        $base = conexion();

        // Iniciar una transacción
        $base->beginTransaction();

        // Registrar el uso del insumo REVISAR TODO ESTOS NOMBRE RAROS
        $insertar_uso = "INSERT INTO stock_positivo (producto_id, stock_agregado,fecha_agregado) VALUES (?, ?, ?)";
        $stmt = $base->prepare($insertar_uso);
        $stmt->execute([$producto_nombre,$cantidad_agregada,$fecha]);

        // Obtener el stock actual del insumo
        $consulta = "SELECT stock_disponible FROM producto WHERE producto_id = ?";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$producto_nombre]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $stock_actual = $fila['stock_disponible'];



              // Obtener el insumo que se necesita
                $consulta2 = "SELECT insumo_id FROM producto_insumo WHERE producto_id = ?";
                $stmt = $base->prepare($consulta2);
                $stmt->execute([$producto_nombre]);
                $fila1 = $stmt->fetchall(PDO::FETCH_ASSOC);
                $i=-1;
        
                foreach ($fila1 as $item) {
                  
                    $i++;
                $insumo_necesitado= $item['insumo_id'];
        
                // Verificamos el stock del insumo
                $consulta4 = "SELECT insumo_disponible FROM insumo WHERE insumo_id = ?";
                $stmt = $base->prepare($consulta4);
                $stmt->execute([$insumo_necesitado]);
                $fila3 = $stmt->fetch(PDO::FETCH_ASSOC);
                $stock_insumo= $fila3['insumo_disponible'];

                // Obtener la cantidad de insumo que se usa para el producto
                $consulta3 = "SELECT cantidad FROM producto_insumo WHERE producto_id = ?";
                $stmt = $base->prepare($consulta3);
                $stmt->execute([$producto_nombre]);
                $fila4 = $stmt->fetchall(PDO::FETCH_ASSOC);
                               
               
                $stock_actual3 = $fila4[$i]['cantidad'];
                $stock_actual3=$fila4[$i]['cantidad'] * $cantidad_agregada;
                echo $stock_actual3;
                
                $stock_actualizado= $stock_insumo - $stock_actual3;
                $actualizar_stock2 = "UPDATE insumo SET insumo_disponible = ? WHERE insumo_id = ?";
                $stmt = $base->prepare($actualizar_stock2);
                $stmt->execute([$stock_actualizado, $insumo_necesitado]);

               
        
            }
        // Calcular la nueva cantidad de stock
        $nuevo_stock = $stock_actual + $cantidad_agregada;
        //Actualizar el stock en la base de datos
        $actualizar_stock = "UPDATE producto SET stock_disponible = ? WHERE producto_id = ?";
        $stmt = $base->prepare($actualizar_stock);
        $stmt->execute([$nuevo_stock, $producto_nombre]);


        // Confirmar la transacción
        $base->commit();
      
        
        

        return true;
    } catch (PDOException $e) {
        // Revertir la transacción en caso de error
        $base->rollBack();
        echo 'Error al registrar el uso del insumo: ' . $e->getMessage();
        return false;
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'producto_agregado') {
    // Obtener los datos del formulario
    $producto_nombre = $_POST['producto_id'];
    $cantidad_agregada=$_POST['cantidad_agregada'];
    $fecha=date("Y-m-d H:i:s");


    // Insertar el proveedor en la base de datos
    if (sumarProducto( $producto_nombre,$cantidad_agregada,$fecha)) {
        echo "Producto insertado correctamente. 1";
        
    } else {
        echo "Error al insertar el Producto 1";
    }
}
};
