<?php
include "../db/conexion.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $base = conexion();
    $consulta =  "SELECT * FROM usuarios WHERE usuario_nombre = ?";
    $stmt = $base->prepare($consulta);
    $stmt->execute([$username]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        $row = $result[0];
        if (password_verify($password, $row['usuario_contraseña'])) {
            $_SESSION['username'] = $username; // Cambié $usuario_nombre a $username
            header('Location: ../index.php');
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<form method="post">
    Username:<br>
    <input type="text" name="username" required>
    <br>
    Password:<br>
    <input type="password" name="password" required>
    <br><br>
    <input type="submit" value="Login">
</form>

<?php
if (isset($error)) {
    echo "<p style='color:red;'>$error</p>";
}
?>

</body>
</html>