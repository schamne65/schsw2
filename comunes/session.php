<?php

function checkLogin() {
    if (!isset($_SESSION['username'])) {
        header('Location: /');
        exit();
    }
}