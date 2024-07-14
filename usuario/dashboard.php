<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

echo "Welcome, " . $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Dashboard</h2>
<p>This is a protected page.</p>
<a href="logout.php">Logout</a>

</body>
</html>