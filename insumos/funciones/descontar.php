<?php


require_once '../../db/conexion.php';

function registrarUsoInsumo($insumo_id, $cantidad_usada,$fecha) {
    try {
        $base = conexion();

        // Iniciar una transacción
        $base->beginTransaction();

        // Registrar el uso del insumo
        $insertar_uso = "INSERT INTO stock_negativo_insumo (insumo_id, stock_usado,fecha_usado) VALUES (?, ?, ?)";
        $stmt = $base->prepare($insertar_uso);
        $stmt->execute([$insumo_id, $cantidad_usada,$fecha]);

        // Obtener el stock actual del insumo
        $consulta = "SELECT insumo_disponible FROM insumo WHERE insumo_id = ?";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$insumo_id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        $stock_actual = $fila['insumo_disponible'];

        // Calcular la nueva cantidad de stock
        $nuevo_stock = $stock_actual - $cantidad_usada;

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
    if ($_POST['tipo'] == 'insumo_descontado') {
    // Obtener los datos del formulario
    $insumo_id = $_POST['id_insumo'];
    $cantidad_usada =$_POST['cantidad_usada'];
    $fecha=date('Y-m-d');


    // Insertar el proveedor en la base de datos
    if (registrarUsoInsumo( $insumo_id,$cantidad_usada,$fecha)) {
        echo "insumo insertado correctamente.";
    } else {
        echo "Error al insertar insumo.";
    }
}
 }
?>
