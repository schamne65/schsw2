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
<h2>Descontar insumos</h2>
    <form action="./funciones/descontar.php" method="POST">
    <input type="hidden" name="tipo" value="insumo_descontado">
        <label for="id_insumo">id</label><br>
        <input type="text" id="id_insumo" name="id_insumo" required ><br><br>

        <label for="cantidad_usada">A descontar</label><br>
        <input type="number" id="cantidad_usada" name="cantidad_usada" required><br><br>

        
        <input type="submit" value="Guardar">
</form>

<?php
include '../db/conexion.php';
$conexiones = conexion();
if ($conexiones) {
     $consulta = "SELECT * FROM stock_negativo_insumo";
     try {
         $stmt = $conexiones->query($consulta);
         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
         if ($resultado) { ?>

        <div>
            <table>
                <tr>
                    <td>ID del insumo</td>
                    <td>Cantidad usada</td>
                    <td>Fecha</td>
                </tr>

           <?php  foreach ($resultado as $row) {?>
                <tr>
                    <td><?php echo $row['insumo_id'] ?></td>
                    <td><?php echo $row['stock_usado'] ?></td>
                    <td><?php echo $row['fecha_usado'] ?></td>
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
