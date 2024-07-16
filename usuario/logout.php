<?php

session_start();
session_unset();
session_destroy();
header('Location: login.php');
exit();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>

<h2>Logout</h2>
<p>You have been logged out.</p>
<a href="login.php">Login again</a>

</body>
</html>
