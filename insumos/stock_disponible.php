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
        include '../db/conexion.php';?>
<section>
    <?php
        $conexiones = conexion();
        if ($conexiones) {
            $consulta = "SELECT * FROM insumo";
            try {
                $stmt = $conexiones->query($consulta);
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
                if ($resultado) { ?>
                 <div class="rojo">
                    <table>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Stock Disponible</td>
                            <td>Lote</td>
                           
                            <td>Stock MIN</td>
                            <td>Proveedor</td>
                            <td>Insumo Deposito</td>
                            <td>Seccion</td>
                        </tr>
                    <?php
                   
                    foreach ($resultado as $row) { 
                      $pedro = ""; // Inicializar la variable en cada iteración
    if ($row['insumo_disponible'] < $row['insumo_stock_min']) {?>
     

    
         <?php } ?>
                     
                        <tr>
                            <td><?php echo $row['insumo_id'] ?></td>
                            <td><?php echo $row['insumo_nombre'] ?></td>
                            <td><?php echo $row['insumo_disponible'] ?></td>
                            <td><?php echo $row['insumo_lote'] ?></td>
                            <td class="rojo"><?php echo $row['insumo_stock_min'] . $pedro ?></td>
                            <!--<td><?php echo $row['insumo_proveedor'] ?></td>-->
                           
                            <!--<td><?php echo $row['insumo_deposito'] ?></td>
                            <td><?php echo $row['insumo_seccion'] ?></td>-->
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