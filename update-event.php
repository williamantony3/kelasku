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
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $res = mysqli_query($conn, "SELECT * FROM event WHERE ID='$id'");
        $row = mysqli_fetch_assoc($res);
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $nama_acara = $_POST['nama_acara'];
            $tanggal_acara = $_POST['tanggal_acara'];
            $waktu_acara = $_POST['waktu_acara'];
            $tempat_acara = $_POST['tempat_acara'];
            $catatan = $_POST['catatan'];
            $nim = $_SESSION['NIM'];
            mysqli_query($conn, "UPDATE event SET Name='$nama_acara', Date='$tanggal_acara', Time='$waktu_acara', Place='$tempat_acara', Note='$catatan', NIM='$nim' WHERE ID='$id'");
            mysqli_query($conn, "UPDATE post SET NIM='$nim', Message='$catatan' WHERE Content='$id'");
            header("Location: events.php");
            $_SESSION['great']="Aksi berhasil";
        }
        
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
    <script>
        function validateForm() {
            var nama_acara = document.forms["addEvent"]["nama_acara"].value;
            var tanggal_acara = document.forms["addEvent"]["tanggal_acara"].value;
            var waktu_acara = document.forms["addEvent"]["waktu_acara"].value;
            var tempat_acara = document.forms["addEvent"]["tempat_acara"].value;
            var catatan = document.forms["addEvent"]["catatan"].value;

            var nama_acaraValid = true;
            if (nama_acara=== "") {
                document.getElementById("folder_name").style.border = "1px solid #FF5252";
                var error = "Nama acara belum diisi";
                var element = document.getElementById("error-nama_acara");
                element.innerHTML = error;
                nama_acaraValid = false;
            }else{
                document.getElementById("folder_name").style.border = "none";
                var element = document.getElementById("error-nama_acara");
                element.innerHTML = "";
                nama_acaraValid = true;
            }
            
            var tanggal_acaraValid = true;
            if (!tanggal_acara) {
                document.getElementById("tanggal_kumpul").style.border = "1px solid #FF5252";
                var error = "Tanggal acara belum diisi";
                var element = document.getElementById("error-tanggal_acara");
                element.innerHTML = error;
                tanggal_acaraValid = false;
            }else{
                document.getElementById("tanggal_kumpul").style.border = "none";
                var element = document.getElementById("error-tanggal_acara");
                element.innerHTML = "";
                tanggal_acaraValid = true;
            }
            
            var waktu_acaraValid = true;
            if (!waktu_acara) {
                document.getElementById("waktu_kumpul").style.border = "1px solid #FF5252";
                var error = "Waktu acara belum diisi";
                var element = document.getElementById("error-waktu_acara");
                element.innerHTML = error;
                waktu_acaraValid = false;
            }else{
                document.getElementById("waktu_kumpul").style.border = "none";
                var element = document.getElementById("error-waktu_acara");
                element.innerHTML = "";
                waktu_acaraValid = true;
            }
            
            var tempat_acaraValid = true;
            if (tempat_acara==="") {
                document.getElementById("tempat_kumpul").style.border = "1px solid #FF5252";
                var error = "Tempat acara belum diisi";
                var element = document.getElementById("error-tempat_acara");
                element.innerHTML = error;
                tempat_acaraValid = false;
            }else{
                document.getElementById("tempat_kumpul").style.border = "none";
                var element = document.getElementById("error-tempat_acara");
                element.innerHTML = "";
                tempat_acaraValid = true;
            }
            
            var catatanValid = true;
            if (catatan==="") {
                document.getElementById("catatan").style.border = "1px solid #FF5252";
                var error = "Catatan belum diisi";
                var element = document.getElementById("error-catatan");
                element.innerHTML = error;
                catatanValid = false;
            }else{
                document.getElementById("catatan").style.border = "none";
                var element = document.getElementById("error-catatan");
                element.innerHTML = "";
                catatanValid = true;
            }

            if(!nama_acaraValid || !tanggal_acaraValid || !waktu_acaraValid || !tempat_acaraValid || !catatanValid){
                return false;
            }
        }
    </script>

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
                        <?php 
                        if(empty($user['ProfilePicture'])){
                        ?>
                        <img src="./assets/images/account.png" alt="" srcset="">
                        <?php }else{ ?>
                        <img src="<?php echo $user['ProfilePicture']; ?>" alt="" srcset="">
                        <?php }  ?>
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
                <form action="" method="post" name="addEvent" onsubmit="return validateForm()">
                <div class='grup-input'>
                    <input type='text' name='nama_acara' id='folder_name' placeholder='Nama Acara' value="<?php echo $row['Name']; ?>">
                    <div class="error-msg" id="error-nama_acara"></div>
                </div>
                <div class='grup-input'>
                    <input type='text' name='tanggal_acara' id='tanggal_kumpul' placeholder='Tanggal Acara' value="<?php echo $row['Date']; ?>">
                    <div class="error-msg" id="error-tanggal_acara"></div>
                </div>
                <div class='grup-input'>
                    <input type='text' name='waktu_acara' id='waktu_kumpul' placeholder='Waktu Acara' value="<?php echo $row['Time']; ?>">
                    <div class="error-msg" id="error-waktu_acara"></div>
                </div>
                <div class='grup-input'>
                    <input type='text' name='tempat_acara' id='tempat_kumpul' placeholder='Tempat Acara' value="<?php echo $row['Place']; ?>">
                    <div class="error-msg" id="error-tempat_acara"></div>
                </div>
                <div class='grup-input'>
                    <textarea rows='10' cols='30' name='catatan' id='catatan' placeholder='Catatan Acara' required><?php echo $row['Note']; ?></textarea>
                    <div class="error-msg" id="error-catatan"></div>
                </div>
                <div class='grup-input'>
                <button name='folder_button' id='folder_button' type="submit"><i class='fas fa-edit'></i> Ubah Acara</button>

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