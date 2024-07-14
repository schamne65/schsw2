<?php


require_once '../../db/conexion.php';

function despacho($insumo_id, $cantidad_usada,  $fecha) {
    try {
        $base = conexion();

        // Iniciar una transacción
        $base->beginTransaction();

        // Registrar el uso del insumo
        $insertar_uso = "INSERT INTO stock_negativo (producto_id, producto_despachado,fecha_despachado) VALUES (?, ?, ?)";
        $stmt = $base->prepare($insertar_uso);
        $stmt->execute([$insumo_id, $cantidad_usada,$fecha]);

        // Obtener el stock actual del insumo
        $consulta = "SELECT stock_disponible FROM producto WHERE producto_id = ?";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$insumo_id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $stock_actual = $fila['stock_disponible'];

        // Calcular la nueva cantidad de stock
        $nuevo_stock = $stock_actual - $cantidad_usada;

        // Actualizar el stock en la base de datos
        $actualizar_stock = "UPDATE producto SET stock_disponible = ? WHERE producto_id = ?";
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
    if ($_POST['tipo'] == 'producto_descontado') {
    // Obtener los datos del formulario
    $insumo_id = $_POST['id_insumo'];
    $cantidad_usada =$_POST['cantidad_usada'];
    $fecha=date('Y-m-d');
    echo $fecha;

    // Insertar el proveedor en la base de datos
    if (despacho( $insumo_id,$cantidad_usada,$fecha)) {
        echo "insumo insertado correctamente.";
    } else {
        echo "Error al insertar insumo.";
    }
}
 }
?>
