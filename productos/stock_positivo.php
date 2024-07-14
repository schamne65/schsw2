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
    <form action="./funciones/insertar.php" method="POST" >
    <input type="hidden" name="tipo" value="producto_agregado">
        <label for="producto_id">ID producto</label><br>
        <input type="text" id="producto_id" name="producto_id" required oninput="fetchProductName(this, '../productos/funciones/nombre.php')"><br><br>
        <label for="producto_nombre">Producto Nombre:</label>
        <input type="text" id="producto_nombre" name="producto_nombre" readonly>

        <label for="cantidad_agregada">A agregar</label><br>
        <input type="number" id="cantidad_agregada" name="cantidad_agregada" required><br><br>

        
        <input type="submit" value="Guardar">
</form>
<?php
include '../db/conexion.php';
$conexiones = conexion();
if ($conexiones) {
     $consulta = //"SELECT * FROM stock_positivo ORDER BY fecha_agregado DESC";
     "SELECT i.producto_id, i.producto_nombre,pi.fecha_agregado, pi.stock_agregado
FROM producto i
JOIN stock_positivo pi ON i.producto_id = pi.producto_id;";
     try {
         $stmt = $conexiones->query($consulta);
         $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);?>
         <div>
            <table>
            <tr>
                <td>ID del Producto</td>
                <td>Nombre Producto</td>
                <td>Cantidad Agregada</td>
                <td>Fecha</td>
            </tr>
 
            <?php if ($resultado) {
                foreach ($resultado as $row) {?>
            <tr>
                <td><?php echo $row['producto_id'] ?></td>
                <td><?php echo $row['producto_nombre'] ?></td>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js">

    </script>
</script>
<script src="../js/script.js"></script>
</body>
</html>