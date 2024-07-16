<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_icon.css">
    
    <title>Tienda Despacho</title>
    
</head>
<body>
<?php  include '../comunes/nav.php';
?>
<section>
<h2>regi</h2>
    <form action="./insertar.php" method="POST" >
    <input type="hidden" name="tipo" value="registro_usuario">
        <label for="usuario_nombre">Nombre Usuario</label>
        <input type="text" id="usuario_nombre" name="usuario_nombre" required >
        
        <label for="usuario_contrasenia">Contraseña</label>
        <input type="password" id="usuario_contrasenia"  name="usuario_contrasenia" required> 

        <label for="usuario_email">E-mail para recuperar contrasenia</label>
        <input type="e-mail" id="usuario_email"  name="usuario_email" > 
      
       
         
        <input type="submit" value="Guardar">
</form>

 </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="../js/script.js"></script>
</body>
</html>