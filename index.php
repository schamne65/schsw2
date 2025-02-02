<?php
session_start();
include './comunes/session.php';
checkLogin();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCH Software</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/style_icon.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body>
    <?php
    include './comunes/nav.php';
    switch ($_SESSION['username']) {
        case 'fabrica24':
            $nombre="o";
            break;
        case 'Juanmanuel':
            $nombre="o Juan Manuel";
            break;
        case 'administracion':
            $nombre="a Araceli";
            break;
        case 'schswadmin':
            $nombre="o Nicolás";
            break;     
       
    }
    ?>
    <section class="index">
        <H2>Bienvenid<?php echo $nombre ?> a</H2>
        <h1>SCH SW</h1>
    </section>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>