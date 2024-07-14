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
 include '../db/conexion.php';
 ?>

<section>
<h2>Producto disponible</h2>

    <?php
        $conexiones = conexion();
        if ($conexiones) {
            $consulta = "SELECT * FROM producto";
            try {
                $stmt = $conexiones->query($consulta);
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
                if ($resultado) { ?>
                 <div>
                    <table>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Producto Disponible </td>
                        </tr>
                    <?php
                    foreach ($resultado as $row) { ?>
                          
                        <tr>
                            <td><?php echo $row['producto_id'] ?></td>
                            <td><?php echo $row['producto_nombre'] ?></td>                         
                            <td><?php echo $row['stock_disponible'] ?></td>
                            
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