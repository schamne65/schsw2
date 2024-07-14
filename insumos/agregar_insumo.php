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
<h2>Agregar un insumo</h2>
    <form action="./funciones/insertar.php" method="POST">
    <input type="hidden" name="tipo" value="insumo">
    <label for="insumo_id">ID:</label><br>
    <input type="text" id="insumo_id" name="insumo_id" required ><br><br>

        <label for="nombre_insumo">Nombre:</label><br>
        <input type="text" id="nombre_insumo" name="nombre_insumo" required ><br><br>

        <label for="stock_actual">Stock</label><br>
        <input type="tel" id="stock_actual" name="stock_actual" required ><br><br>

        <label for="lote">Lote:</label><br>
        <input type="text" id="lote" name="lote" required><br><br>

        <label for="stock_min">Stock min</label><br>
        <input type="tel" id="stock_min" name="stock_min" required ><br><br>        

        <label for="deposito">Deposito</label><br>
        <input type="tel" id="deposito" name="deposito" required ><br><br>

        <label for="proveedor">Proveedor</label><br>
        <input type="tel" id="proveedor" name="proveedor" required ><br><br>

        <label for="id_proveedor">Id del proveedor</label><br>
        <input type="tel" id="id_proveedor" name="id_proveedor" required ><br><br>

        
        <input type="submit" value="Guardar">
    </form>

</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>