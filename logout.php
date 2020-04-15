<?php
    session_start();
    require_once "config.php";
    unset($_SESSION['NIM']);
    unset($_SESSION['Role']);
    // session_destroy();
    header("Location: login.php");
?>