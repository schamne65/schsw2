<?php
session_start();
include "../db/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $base = conexion();
    $consulta =  "SELECT * FROM usuarios WHERE usuario_nombre = ?";
    $stmt = $base->prepare($consulta);
    $stmt->execute([$username]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $row = $result[0];
        if (password_verify($password, $row['usuario_contrasenia'])) {
            $_SESSION['username'] = $username; // Guardar nombre de usuario en la sesión
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Contraseña inválida.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_icon.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body class="login">
    <?php
    echo $_SESSION['username'];
    echo $username;
    ?>

<section>
        <h1>SCH SW</h1>
        <h2>Login Regidiet</h2>
        <form method="POST">
            <label for="username">Usuario:</label><br>
            <input type="text" name="username" id="username" required><br>
            <label for="password">Contraseña:</label><br>
            <input type="password" name="password" id="password" required><br><br>
            <input type="submit" value="Login">
        </form>
</section>      




<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
</body>
</html>