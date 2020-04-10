<?php
    include "config.php";
    if(!isset($_SESSION['NIM'])){
        header("Location: login.php");
    }

    //dapetin jumlah siswa
    $query = mysqli_query($conn, "SELECT * FROM user");
    $jumlahSiswa = mysqli_num_rows($query);

    //masukin dari 1 - jumlah siswa ke array tempat duduk
    $arraySeatNumber = array();
    for ($i = 1; $i <= $jumlahSiswa; $i++) { 
        array_push($arraySeatNumber, $i);
    }

    //ambil angka random
    $index = -1;
    while ($siswa = mysqli_fetch_assoc($query)) {
        $index = mt_rand(0, count($arraySeatNumber)-1);
        //ambil nim yang diubah
        $nim = $siswa['NIM'];
        $seatNumber = $arraySeatNumber[$index];
        mysqli_query($conn, "UPDATE user SET SeatNumber='$seatNumber' WHERE NIM='$nim'");
        array_splice($arraySeatNumber, $index, 1);
    }
    header("Location: seating.php");
?>