<?php

function checkLogin() {
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
}