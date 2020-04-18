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
    $id = $_GET['id'];
    $resPost = mysqli_query($conn, "SELECT * FROM post WHERE ID='$id'");
    $rowPost = mysqli_fetch_assoc($resPost);
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $catatan = $_POST['catatan'];
        $nim = $_SESSION['NIM'];
        mysqli_query($conn, "UPDATE post SET Message='$catatan', Content='$catatan', NIM='$nim' WHERE ID='$id'");
        $_SESSION['great'] = "Aksi Berhasil";
        header("Location: index.php");
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
            var catatan = document.forms["createPost"]["catatan"].value;
            
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

            if(!catatanValid){
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
                    <a href="events.php"><div class="menu-item"><i class="fas fa-calendar"></i> Acara Kelas</div></a>
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
                <h1>Ubah Postingan</h1>
                <a href="index.php"><button><i class="fas fa-angle-left"></i> Kembali</button></a>
            </div>
            <div class="kotak">
                <form action="" method="post" name="createPost" onsubmit="return validateForm()">
                <div class='grup-input'>
                    <textarea rows='10' cols='30' name='catatan' id='catatan' placeholder='Apa yang kamu pikirkan?' style="width: 80%;"><?php echo $rowPost['Message']; ?></textarea>
                    <div class="error-msg" id="error-catatan"></div>
                </div>
                <div class='grup-input'>
                <button name='folder_button' id='folder_button' type="submit"><i class='fas fa-pencil-alt'></i> Ubah Postingan</button>

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