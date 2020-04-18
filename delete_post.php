<?php
session_start();
require_once "config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM post WHERE ID='$id'");$_SESSION['great'] = "Aksi Berhasil";
    header("Location: index.php");
}
?>