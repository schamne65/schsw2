<?php
include '../db/conexion.php';
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
        input{width:70px;margin:0 5px 20px}
    </style>
</head>
<body>
<?php
include '../db/conexion.php';
checkLogin();
include '../comunes/nav.php';
?>
<section>
<h2>Pedido de Reposicion o Influencer</h2>
    <form action="./funciones/insertar.php" method="POST" >
    <input type="hidden" name="tipo" value="producto_agregado">
        <label for="cliente_id">Cliente</label>
        <input type="text" id="cliente_id" name="cliente_id" required >
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
         
        <input type="submit" value="Guardar">

</form>
 </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>