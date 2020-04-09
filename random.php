<?php
    include "config.php";
    if(!isset($_SESSION['NIM'])){
        header("Location: login.php");
    }
    $query = mysqli_query($conn, "SELECT * FROM user");
    $jumlahSiswa = mysqli_num_rows($query);
    echo $jumlahSiswa;
    $arraySeatNumber = array();
    for ($i=1; $i<=$jumlahSiswa; $i++) { 
        array_push($arraySeatNumber, $i);
    }
    for ($i=1; $i<=count($arraySeatNumber) ; $i++) { 
        echo "Kursi " . $i;
    }
?>