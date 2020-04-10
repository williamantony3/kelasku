<?php
    include "config.php";
    unset($_SESSION['NIM']);
    unset($_SESSION['Role']);
    // session_destroy();
    header("Location: login.php");
?>