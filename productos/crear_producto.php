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
<h2>Agregar un Producto</h2>
    <form  action="./funciones/insertar.php" method="POST"  >
   
    <input type="hidden" name="tipo" value="producto">
    
        <label for="nombre_producto">Nombre:</label><br>
        <input type="text" id="nombre_producto" name="nombre_producto" required  ><br><br>
        <label for="producto_id">id del producto</label><br>
        <input type="text" id="producto_id" name="producto_id" required ><br><br>
        <label for="stock_min">Stock Min</label><br>
        <input type="text" id="stock_min" name="stock_min" required ><br><br>
        <label for="deposito_nombre">Deposito</label><br>
        <input type="text" id="deposito_nombre" name="deposito_nombre" required ><br><br>
                
       <div id="inputContainer">        
               
                <label for="insumo_id_0">Insumos id:</label><br>
                    <input type="text" id="insumo_id_0" name="insumo_id_0" required oninput="fetchInsumoName(this, '../productos/funciones/nombre.php',0 )"><br><br>
                    <label for="insumo_nombre_0">Insumo Nombre:</label>
                    <input type="text" id="insumo_nombre_0" name="insumo_nombre_0" readonly>
                <label for="insumo_cantidad_usada_0">Cantidad necesaria</label><br>
                    <input type="text" id="insumo_cantidad_usada_0" name="insumo_cantidad_usada_0" required ><br><br>          
                <button class="icon-plus"><span ></span></button>  
        </div>
        
        <input class="enviar" type="submit" value="Guardar">
    </form>
    
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
                            <td>Nombre</td>
                            <td>Stock Disponible</td>
                            <td>Stock MIN</td>
                            <td>producto Deposito</td>
                        </tr>
                    <?php
                    foreach ($resultado as $row) { ?>
                        <tr>

                            <td><?php echo $row['producto_nombre'] ?></td>
                            <td><?php echo $row['stock_disponible'] ?></td>
                            <td><?php echo $row['stock_min'] ?></td>
                            <td><?php echo $row['deposito_nombre'] ?></td>
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