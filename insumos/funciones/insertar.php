<?php
include "../../db/conexion.php";

function insertarProveedor($nombre, $direccion, $telefono) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO proveedores (proveedores_nombre, proveedores_direccion, proveedores_telefono) VALUES (?, ?, ?)";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$nombre, $direccion, $telefono]);
        return true;
    } catch (PDOException $e) {
        echo 'Error al insertar proveedor: ' . $e->getMessage();
        return false;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'proveedor') {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Insertar el proveedor en la base de datos
    if (insertarProveedor($nombre, $direccion, $telefono)) {
        echo "Proveedor insertado correctamente.";
    } else {
        echo "Error al insertar proveedor.";
    }
}
}

function insertarInsumo($insumo_id,$nombre_insumo,$stock_actual,$lote, $proveedor,$stock_min,$deposito,$id_proveedor) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO insumo (insumo_id,insumo_nombre,insumo_disponible, insumo_lote, proveedor_nombre,insumo_stock_min,deposito_numero,proveedor_id) VALUES (?, ?, ?, ?, ?, ?, ?, ? )";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$insumo_id,$nombre_insumo,$stock_actual, $lote, $proveedor,$stock_min,$deposito,$id_proveedor,]);
        return true;
    } catch (PDOException $e) {
        echo 'Error al insertar insumo: ' . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'insumo') {
    // Obtener los datos del formulario
    $insumo_id= $_POST['insumo_id'];
    $nombre_insumo = $_POST['nombre_insumo'];
    $stock_actual= $_POST['stock_actual'];
    $lote= $_POST['lote'];
    $proveedor = $_POST['proveedor'];
    $stock_min= $_POST['stock_min'];
    $deposito = $_POST['deposito'];
    $id_proveedor= $_POST['id_proveedor'];
    

    // Insertar el proveedor en la base de datos
    if (insertarinsumo($insumo_id,$nombre_insumo,$stock_actual, $lote, $proveedor,$stock_min,$deposito,$id_proveedor)) {
        echo "insumo insertado correctamente.";
    } else {
        echo "Error al insertar insumo.";
    }
}
 }



function sumarInsumos($insumo_id, $cantidad_agregada) {
    try {
        $base = conexion();

        // Iniciar una transacción
        $base->beginTransaction();

        // Registrar el uso del insumo
        $insertar_uso = "INSERT INTO stock_positivo_insumo (insumo_id, stock_agregado) VALUES (?, ?)";
        $stmt = $base->prepare($insertar_uso);
        $stmt->execute([$insumo_id, $cantidad_agregada]);

        // Obtener el stock actual del insumo
        $consulta = "SELECT insumo_disponible FROM insumo WHERE insumo_id = ?";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$insumo_id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $stock_actual = $fila['insumo_disponible'];

        // Calcular la nueva cantidad de stock
        $nuevo_stock = $stock_actual + $cantidad_agregada;

        // Actualizar el stock en la base de datos
        $actualizar_stock = "UPDATE insumo SET insumo_disponible = ? WHERE insumo_id = ?";
        $stmt = $base->prepare($actualizar_stock);
        $stmt->execute([$nuevo_stock, $insumo_id]);

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
    if ($_POST['tipo'] == 'insumo_agregado') {
    // Obtener los datos del formulario
    $insumo_id = $_POST['id_insumo'];
    $cantidad_agregada=$_POST['cantidad_agregada'];

    // Insertar el proveedor en la base de datos
    if (sumarInsumos( $insumo_id,$cantidad_agregada)) {
        echo "insumo insertado correctamente.";
    } else {
        echo "Error al insertar insumo.";
    }
}
 }
?>

