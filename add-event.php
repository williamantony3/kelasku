<?php
    session_start();
    require_once "config.php";
    if(!isset($_SESSION['NIM'])){
        header("Location: login.php");
    }
    $nim = $_SESSION['NIM'];
    $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE NIM='$nim'");
    $user = mysqli_fetch_assoc($queryUser);

    function siapaNomor($angka){
        global $conn;
        $cari = mysqli_query($conn, "SELECT * FROM user WHERE SeatNumber='$angka'");
        if(mysqli_num_rows($cari) == 0){
            echo "-";
        }else{
            $orang = mysqli_fetch_assoc($cari);
            if($orang['NIM'] == $_SESSION['NIM']){
                echo "<div style='background-color: white; color:#7C4DFF;'>" . $orang['Username'] . "</div>";
            }else{
                echo $orang['Username'];
            }
        }
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nama_acara = $_POST['nama_acara'];
        $tanggal_acara = $_POST['tanggal_acara'];
        $waktu_acara = $_POST['waktu_acara'];
        $tempat_acara = $_POST['tempat_acara'];
        $catatan = $_POST['catatan'];
        $nim = $_SESSION['NIM'];
        $query = mysqli_query($conn, "INSERT INTO event (Name, Date, Time, Place, Note, NIM) VALUES ('$nama_acara', '$tanggal_acara', '$waktu_acara', '$tempat_acara', '$catatan', '$nim')");
        if($query){
            $id = mysqli_insert_id($conn);
            mysqli_query($conn, "INSERT INTO post (NIM, Message, Type, Content) VALUES ('$nim', '$catatan', 1, '$id')");
        }
        header("Location: events.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelasku</title>
    <link rel="shortcut icon" href="./assets/images/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.12.1-web/css/all.css">
    <!-- <link rel="stylesheet" href="./assets/jquery-ui.css"> -->
    <!-- <link rel="stylesheet" href="./assets/bootstrap-4.4.1-dist/css/bootstrap.min.css"> -->
    <script src="./assets/scripts/jquery-3.4.1.min.js"></script>
    <!-- <link rel="stylesheet" href="./assets/dropzone/dropzone.css"> -->
    <!-- <script src="./assets/dropzone/dropzone.js"></script> -->
    <!-- <script src="./assets/scripts/jquery-ui.js"></script> -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" /> -->
    <link rel="stylesheet" href="./assets/fullcalendar.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="./assets/locale.js"></script>
    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('jam').innerHTML =
            h + ":" + m + ":" + s;
            var t = setTimeout(startTime, 500);
        }
        function checkTime(i) {
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }
    </script>
    <style>
        .fc-right .fc-prev-button, .fc-right .fc-next-button{
            display: none;
        }
    </style>

</head>
<body onload="startTime()">
    <nav>
        <div class="container space-between">
            <div id="nav-kiri">
                <div id="logo-kelas">
                    <img src="./assets/images/icon.jpg" alt="">
                </div>
                <div id="menu">
                    <a href="index.php"><div class="menu-item"><i class="fas fa-home"></i> Beranda</div></a>
                    <a href="turn-in.php"><div class="menu-item"><i class="fas fa-edit"></i> Kumpul Tugas</div></a>
                    <a href="materials.php"><div class="menu-item"><i class="fas fa-book"></i> Materi Kuliah</div></a>
                    <a href="seating.php"><div class="menu-item"><i class="fas fa-chair"></i> Cek Kursi</div></a>
                    <a href="events.php"><div class="menu-item selected"><i class="fas fa-calendar"></i> Acara Kelas</div></a>
                </div>
            </div>
            <div id="nav-kanan">
                <div id="nama">
                    <?php echo $user['Name']; ?>
                    <div id="dropdown-nav-kanan">
                        <a href="profile.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-user"></i> Ubah Profil</div></a>
                        <a href="logout.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-sign-out-alt"></i> Keluar</div></a>
                    </div>
                </div>
                <div id="profil">
                    <img src="./assets/images/account.png" alt="">
                </div>
            </div>
        </div>
    </nav>
    <div id="konfirmasi">
        <div id="konfirmasi-box">
            <div id="konfirmasi-logo">
                <i class="fas fa-check-circle"></i>
            </div>
            <div id="konfirmasi-pesan">
                Kamu yakin ingin melanjutkan?
            </div>
            <div id="konfirmasi-button">
                <button class="delete">Ya</button>
                <button class="remove_file">Ya</button>
                <button class="cancel">Tidak</button>
            </div>
        </div>
    </div>
    <div class="container">
        <section>
            <div class="judul-section">
                <h1>Acara Kelas</h1>
                <a href="events.php"><button id="up"><i class="fas fa-angle-left"></i> Kembali</button></a>
            </div>
            <div class="kotak">
                <form action="" method="post">
                <div class='grup-input'>
                    <input type='text' name='nama_acara' id='folder_name' placeholder='Nama Acara' required>
                </div>
                <div class='grup-input'>
                    <input type='text' name='tanggal_acara' id='tanggal_kumpul' placeholder='Tanggal Acara' required>
                </div>
                <div class='grup-input'>
                    <input type='text' name='waktu_acara' id='waktu_kumpul' placeholder='Waktu Acara' required>
                </div>
                <div class='grup-input'>
                    <input type='text' name='tempat_acara' id='tempat_kumpul' placeholder='Tempat Acara' required>
                </div>
                <div class='grup-input'>
                    <textarea rows='10' cols='30' name='catatan' id='catatan' placeholder='Catatan Acara' required></textarea>
                </div>
                <div class='grup-input'>
                <button name='folder_button' id='folder_button' type="submit"><i class='fas fa-calendar'></i> Buat Acara</button>

                </form>
            </div>
            </div> 
            <footer>
                2020 &copy; CIH!
            </footer>
        </section>
    </div>
    <script src="events.js"></script>
<?php include "footer.php"; ?>