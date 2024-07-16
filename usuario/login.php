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
</head>
<body>
    <?php
    echo $_SESSION['username'];
    echo $username;
    ?>
<h2>Login pauletti</h2>
<form method="POST">
    <label for="username">Usuario:</label><br>
    <input type="text" name="username" id="username" required><br>
    <label for="password">Contraseña:</label><br>
    <input type="password" name="password" id="password" required><br><br>
    <input type="submit" value="Login">
</form>

<button><a href="./registro.php">registrarse</a></button>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>
</body>
</html>