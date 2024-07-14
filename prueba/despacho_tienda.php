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
include '../comunes/nav.php';
include '../db/conexion.php';
checkLogin();
?>
<section>
<h2>Despachar pedido</h2>
    <form action="./funciones/insertar.php" method="POST" >
    <input type="hidden" name="tipo" value="estado_pedido_1">
    
        <label for="cliente_id"> Cliente:</label>
        <input type="text" id="cliente_id" name="cliente_id" requerid>
        <label for="estado_pedido">Tipo de pedido</label>
        <select name="estado_pedido" id="estado_pedido">
        <option value="Preparando" >En Preparacion</option>
        <option value="Esperando despacho" >Esperando despacho</option>
        <option value="Despachado" >Despachado</option>
        </select>
        <input type="submit" value="Guardar">
</form>
 </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>