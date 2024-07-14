<?php
include "../../db/conexion.php";
function insertarTarea($tarea_nombre,$tarea_responsable,$tarea_fecha,$tarea_archivo) {
    try {
        $base = conexion();
        $consulta = "INSERT INTO asignar_tarea (tarea_nombre,tarea_responsable,tarea_fecha,tarea_archivo) VALUES ( ?, ?, ?, ? )";
        $stmt = $base->prepare($consulta);
        $stmt->execute([$tarea_nombre,$tarea_responsable,$tarea_fecha,$tarea_archivo]);
        return true;
    } catch (PDOException $e) {
        echo 'Error al insertar la tarea: ' . $e->getMessage();
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['tipo'] == 'tarea_agregada') {
    // Obtener los datos del formulario
    $tarea_nombre = $_POST['tarea_nombre'];
    $tarea_responsable= $_POST['tarea_responsable'];
    $tarea_fecha = $_POST['tarea_fecha'];
    $tarea_archivo = $_POST['tarea_archivo'];
   

    // Insertar el proveedor en la base de datos
    if (insertarTarea($tarea_nombre,$tarea_responsable,$tarea_fecha,$tarea_archivo)) {
        echo "La tarea fue agendada correctamente.";
    } else {
        echo "Error al insertar la tarea";
    }
}
 }


