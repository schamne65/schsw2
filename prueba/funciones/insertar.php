<?php
include "../../db/conexion.php";

function despachoTiendaNube($cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO despacho_tienda_nube (id_cliente,tipo_pedido,caja_mixtas,dulce_leche,dulce_cacao,mermelada_frutilla,mermelada_durazno,nombre_responsable,codigo_barra,fecha_armado) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha]);
    
    return true;
    
} catch (PDOException $e) {
    echo 'aca Error al insertar pedido' . $e->getMessage();
    return false;
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'tienda_nube') {
        $cliente_id = $_POST['cliente_id'];
        $tipo_pedido = $_POST['tipo_pedido'];
        $cajas_mixtas = $_POST['cajas_mixtas'];
        $dulce_leche = $_POST['dulce_leche'];
        $dulce_cacao = $_POST['dulce_cacao'];
        $mermelada_frutilla = $_POST['mermelada_frutilla'];
        $mermelada_durazno = $_POST['mermelada_durazno'];
        $nombre_responsable = $_POST['nombre_responsable']; 
        $codigo = $_POST['barra']; 
        $fecha=date("Y-m-d H:i:s");

    

    // Insertar el proveedor en la base de datos
    if (despachoTiendaNube($cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha)) {
        
    } else {
        echo "Error al insertar insumo.";
    }
}
 };
 

 function despachoTiendaNubeModificado($cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha) {
    try {
        $base = conexion();
        $consulta = "UPDATE  despacho_tienda_nube SET id_cliente = ?,tipo_pedido = ?,caja_mixtas = ?,dulce_leche = ?,dulce_cacao = ?,mermelada_frutilla = ?,mermelada_durazno = ?,nombre_responsable = ?,codigo_barra = ?,fecha_armado = ? WHERE id_cliente = ?";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha]);
    
    return true;
    
} catch (PDOException $e) {
    echo 'aca Error al insertar pedido' . $e->getMessage();
    return false;
}
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'tienda_nube_modificado') {
        $cliente_id = $_POST['cliente_id'];
        $tipo_pedido = $_POST['tipo_pedido'];
        $cajas_mixtas = $_POST['cajas_mixtas'];
        $dulce_leche = $_POST['dulce_leche'];
        $dulce_cacao = $_POST['dulce_cacao'];
        $mermelada_frutilla = $_POST['mermelada_frutilla'];
        $mermelada_durazno = $_POST['mermelada_durazno'];
        $nombre_responsable = $_POST['nombre_responsable']; 
        $codigo = $_POST['barra']; 
        $fecha=date("Y-m-d H:i:s");

    

    // Insertar el proveedor en la base de datos
    if (despachoTiendaNubeModificado($cliente_id,$tipo_pedido,$cajas_mixtas,$dulce_leche,$dulce_cacao,$mermelada_frutilla,$mermelada_durazno,$nombre_responsable,$codigo,$fecha)) {
        
    } else {
        echo "Error al insertar insumo.";
    }
}
 }


 function despachoEstado($cliente_id,$estado_pedido) {
    try {
 $base = conexion();
 $actualizar_estado = "UPDATE despacho_tienda_nube SET estado_pedido = ? WHERE codigo_barra = ?";
 $stmt = $base->prepare($actualizar_estado);
 $stmt->execute([$estado_pedido,$cliente_id]);
    return true;
    
} catch (PDOException $e) {
    echo 'aca Error al insertar pedido' . $e->getMessage();
    return false;
}
 }

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'estado_pedido_1') {
        $cliente_id = $_POST['cliente_id'];
        $estado_pedido = $_POST['estado_pedido'];
        $fecha=date("Y-m-d H:i:s");

    

    // Insertar el proveedor en la base de datos
    if (despachoEstado($cliente_id,$estado_pedido)) {
       
    } else {
        echo "Error al insertar insumo.";
    }
}
 } 