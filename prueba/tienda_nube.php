<?php
include '../comunes/session.php';
checkLogin();


// Verifica si la sesión está activa
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 500)) {
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
    
    <title>Tienda Despacho </title>
    <style>
        input{width: 60px;margin:0 5px 20px}
    </style>
</head>
<body>
<?php  include '../comunes/nav.php';
include '../db/conexion.php'; ?>
<section>
<h2>Pedidos Tienda Nube Modificar valores</h2>
    <form action="./funciones/insertar.php" method="POST" ></form>
<?php
if ($_SESSION['username'] == "schswadmin") {?>
    <input type="hidden" name="tipo" value="tienda_nube_modificado">

<?php } else { ?>
    <input type="hidden" name="tipo" value="tienda_nube">
        
<?php } ?>
<label for="cliente_id">Doc. Cliente</label>
        <input autofocus type="text" id="cliente_id" name="cliente_id" required >
        <label for="tipo_pedido">Tipo de pedido</label>
        <select name="tipo_pedido" id="tipo_pedido">
            <option value="Cajas estandar" >Cajas tipo estandar</option>
            <option value="Pedido personalizado"  >Frascos</option>
        </select>
        <div>
        <label for="cajas_mixtas">Caja Mixtas</label>
        <input type="number" id="cajas_mixtas" value="0" name="cajas_mixtas" required> 
        <label for="dulce_leche">Dulce de Leche</label>
       <input type="number" id="dulce_leche" value="0" name="dulce_leche" required> 
       <label for="dulce_cacao">Dulce de leche con Cacao</label>
       <input type="number" id="dulce_cacao" value="0" name="dulce_cacao" required> 
       <label for="mermelada_frutilla">Mermelada de frutilla</label>
       <input type="number" id="mermelada_frutilla" value="0" name="mermelada_frutilla" required> 
       <label for="mermelada_durazno">Mermelada de durazno</label>
       <input type="number" id="mermelada_durazno" value="0" name="mermelada_durazno" required> 
       </div>

        <label for="nombre_responsable"> Nombre Responsable:</label>
        <input type="text" id="nombre_responsable" name="nombre_responsable" requerid>

        <label for="barra"> Codigo de barra:</label>
        <input type="text" id="barra" name="barra" requerid>
         
        <input class="guardar" type="submit" value="Guardar">
</form>





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
                            <td>Tipo de pedido</td>
                            <td>Cajas Mixtas</td>
                            <td>Dulce de leche</td>
                            <td>Dulce con Cacao</td>
                            <td>Mermelada de Frutilla</td>
                            <td>Mermelada de Durazno</td>
                            <td>Responsable</td>
                            <td>Fecha armado</td>
                            <td>Estado del pedido</td>

                        </tr>
                    <?php
                    foreach ($resultado as $row) { ?>
                          
                        <tr>
                            <td><?php echo $row['id_cliente'] ?></td>
                            <td><?php echo $row['tipo_pedido'] ?></td>                         
                            <td><?php echo $row['caja_mixtas'] ?></td>
                            <td><?php echo $row['dulce_leche'] ?></td>
                            <td><?php echo $row['dulce_cacao'] ?></td>                         
                            <td><?php echo $row['mermelada_frutilla'] ?></td>
                            <td><?php echo $row['mermelada_durazno'] ?></td>
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