<?php
include "../db/conexion.php";

function despachoTiendaNube($usuario_nombre,$usuario_contasenia,$usuario_email) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO usuarios (usuario_nombre,usuario_contrasenia,usuario_email) VALUES ( ?, ?, ?)";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$usuario_nombre,$usuario_contasenia,$usuario_email]);
    
    return true;
    
} catch (PDOException $e) {
    echo 'aca Error al insertar pedido' . $e->getMessage();
    return false;
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'registro_usuario') {
        $usuario_nombre = $_POST['usuario_nombre'];
        $usuario_contasenia = password_hash($_POST['usuario_contrasenia'], PASSWORD_DEFAULT);
        $usuario_email = $_POST['usuario_email'];
        

    

    // Insertar el proveedor en la base de datos
    if (despachoTiendaNube($usuario_nombre,$usuario_contasenia,$usuario_email)) {
        echo "insumo insertado correctamente.";
    } else {
        echo "Error al insertar insumo.";
    }
}
 }