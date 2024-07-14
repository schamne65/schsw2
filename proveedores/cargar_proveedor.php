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
<h2>Formulario de Proveedor</h2>
    <form action="../insumos/funciones/insertar.php" method="POST">
    <input type="hidden" id="tipo" name="tipo" value="proveedor">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required ><br><br>

        <label for="direccion">Dirección:</label><br>
        <input type="text" id="direccion" name="direccion" required><br><br>

        <label for="telefono">Teléfono:</label><br>
        <input type="tel" id="telefono" name="telefono" required pattern="[0-9]{7,14}"><br><br>

        <input type="submit" value="Guardar">
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>