<?php
include '../comunes/session.php';
checkLogin();


// Verifica si la sesión está activa
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 45)) {
    // Si la última actividad fue hace más de 15 minutos, borra la sesión
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
}

// Actualiza la última actividad de la sesión
$_SESSION['LAST_ACTIVITY'] = time();

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_icon.css">
    
    <title>Tienda Nube</title>
    <style>
        input{width:60px;margin:0 5px 20px}
    </style>
</head>
<body>
<?php
include '../comunes/nav.php';

include '../db/conexion.php';

?>
<section>
    <div class="div-fixed">
<h2>Despachar pedido</h2>
    <form action="./funciones/insertar.php" method="POST" >
    <input type="hidden" name="tipo" value="estado_pedido_1">
        <label for="estado_pedido">Estado del pedido</label>
        <select  autofocus name="estado_pedido" id="estado_pedido">
        <option value="Despachado" >Despachado</option>
        <option value="Preparando" >En Preparacion</option>
        <option value="Esperando despacho" >Esperando despacho</option>
        </select>
        <label for="cliente_id"> Codigo de barra:</label>
        <input type="text" id="cliente_id" name="cliente_id" requerid>
        
        
        <input type="submit" value="Guardar">
</form>
</div>
<?php

        $conexiones = conexion();
        if ($conexiones) {
            $consulta = "SELECT * FROM despacho_tienda_nube ORDER BY fecha_armado DESC";
            try {
                $stmt = $conexiones->query($consulta);
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
                if ($resultado) { ?>
                 <div>
                    <table>
                        <tr>
                            <td>Doc. Cliente</td>
                            <td>Codigo de barra</td>
                            <td>Responsable</td>
                            <td>Fecha armado</td>
                            <td>Estado del pedido</td>

                        </tr>
                    <?php
                    foreach ($resultado as $row) { ?>
                          
                        <tr>
                            <td><?php echo $row['id_cliente'] ?></td>
                            <td><?php echo $row['codigo_barra'] ?></td>
                            <td><?php echo $row['nombre_responsable'] ?></td> 
                            <td><?php echo $row['fecha_armado'] ?></td> 
                            <?php
                            switch ($row['estado_pedido']) {
                                case 'En Preparacion':?>
                                    <td style="background:red;"><?php echo $row['estado_pedido'] ?></td>
                                <?php    break;
                                   case 'Esperando despacho'?>
                                   <td style="background:yellow;"><?php echo $row['estado_pedido'] ?></td>
                                <?php break; 
                                    case 'Despachado' ?>
                                    <td style="background:#00ff80;"><?php echo $row['estado_pedido'] ?></td>
                                <?php
                                    break;
                            }
                            
                            ?>  
                                                   
                            
                            
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