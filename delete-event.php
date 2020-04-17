<?php
session_start();
require_once "config.php";
if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM event WHERE ID='$id'");
    mysqli_query($conn, "DELETE FROM post WHERE Content='$id'");
    header("Location: events.php");
}
?>