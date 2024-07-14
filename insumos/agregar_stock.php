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
<h2>Stock Positivo</h2>
    <form action="./funciones/insertar.php" method="POST">
    <input type="hidden" name="tipo" value="insumo_agregado">
        <label for="id_insumo">id</label><br>
        <input type="text" id="id_insumo" name="id_insumo" required ><br><br>

        <label for="cantidad_agregada">A agregar</label><br>
        <input type="number" id="cantidad_agregada" name="cantidad_agregada" required><br><br>

        
        <input type="submit" value="Guardar">
</form>



<?php
include '../db/conexion.php';
$conexiones = conexion();
if ($conexiones) {
     $consulta = "SELECT * FROM stock_positivo ORDER BY fecha_agregado DESC";
     try {
         $stmt = $conexiones->query($consulta);
         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
         <div>
            <table>
            <tr>
                <td>ID del insumo</td>
                <td>Cantidad Agregada</td>
                <td>Fecha</td>
            </tr>
 
            <?php if ($resultado) {
                foreach ($resultado as $row) {?>
            <tr>
                <td><?php echo $row['insumo_id'] ?></td>
                <td><?php echo $row['stock_agregado'] ?></td>
                <td><?php echo $row['fecha_agregado'] ?></td>
            </tr>   
         
        <?php                 
             } ?>

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