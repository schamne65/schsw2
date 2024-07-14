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
include '../comunes/nav.php';
?>
<section>
<h2>Asignar Tarea</h2>
    <form action="./funciones/funciones.php" method="POST">
    <input type="hidden" name="tipo" value="tarea_agregada">
        <label for="tarea_nombre">Tarea</label><br>
        <input type="text" id="tarea_nombre" name="tarea_nombre" required ><br><br>

        <label for="tarea_responsable">Responsable</label><br>
        <input type="text" id="tarea_responsable" name="tarea_responsable" required><br><br>
        <label for="tarea_fecha">Fecha</label><br>
        <input type="date" id="tarea_fecha" name="tarea_fecha" required><br><br>
        <label for="tarea_archivo">Formulacion</label><br>
        <input type="file" id="tarea_archivo" name="tarea_archivo" required><br><br>

        
        <input type="submit" value="Guardar">
</form>
<?php
include '../db/conexion.php';
$conexiones = conexion();
if ($conexiones) {
     $consulta = "SELECT * FROM asignar_tarea ORDER BY tarea_fecha DESC";
     try {
         $stmt = $conexiones->query($consulta);
         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
         if ($resultado) { ?>
            <div>
            <table>
                        <tr>
                            <td>ID</td>
                            <td>Tarea</td>
                            <td>Responsable</td>
                            <td>Fecha a realizarse</td>
                            <td>Formulacion</td>
                           
                        </tr>
             <?php
               foreach ($resultado as $row) { 
                $fecha_original = $row['tarea_fecha'];
                $fecha_invertida = date("d-m-Y", strtotime($fecha_original));
                ?>
            
                <tr>
                <td><?php echo $row['tarea_id'] ?></td>
                <td><?php echo $row['tarea_nombre'] ?></td>
                <td><?php echo $row['tarea_responsable'] ?></td>
                <td><?php echo $fecha_invertida ?></td>
                <td><a href="<?php echo $row['tarea_archivo'] ?> downland"><?php echo $row['tarea_archivo'] ?></a></td>
                
            </tr>   
            <?php } ?>
            </table>  
        </div>   
         <?php   
         } else {
             echo "No se encontraron datos en la tabla inventario. 2";
         }
     } catch (PDOException $e) {
         echo 'Error en la consulta: 3' . $e->getMessage() ;
     }
 } else {
     echo 'No se pudo establecer la conexión a la base de datos.4';
 }
 ?>
 </section>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>