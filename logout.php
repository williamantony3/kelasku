<?php
    include "config.php";
    unset($_SESSION['NIM']);
    // session_destroy();
    header("Location: login.php");
?>