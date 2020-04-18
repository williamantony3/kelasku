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
        $nama = $_POST['nama'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $email = $_POST['email'];
        if($_FILES['gambar']['name'] != ""){
            $data = explode(".", $_FILES['gambar']['name']);
            $extension = $data[1];
            $allowed_extension = array("jpg", "png", "jpeg", "JPG", "PNG", "JPEG");
            if(in_array($extension, $allowed_extension)){
                $new_file_name = $_SESSION['NIM'] . "." . $extension;
                $path = "users/".$new_file_name;
                if(move_uploaded_file($_FILES['gambar']['tmp_name'], $path)){
                    mysqli_query($conn, "UPDATE user SET Name='$nama', Username='$username', Password='$password', Email='$email', ProfilePicture='$path' WHERE NIM='$nim'");
                    $_SESSION['great'] = "Aksi berhasil";
                    // header("Location: profile.php");
                    // echo $msg;
                }else{
                    $_SESSION['error'] = "Kesalahan saat mengunggah gambar";
                }
            }else{
                $_SESSION['error'] = "Ekstensi berkas tidak didukung";
            }
        }else{
            mysqli_query($conn, "UPDATE user SET Name='$nama', Username='$username', Password='$password', Email='$email' WHERE NIM='$nim'");
            $_SESSION['great'] = "Aksi berhasil";
            // header("Location: profile.php");
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
            var nama = document.forms["editProfile"]["nama"].value;
            var username = document.forms["editProfile"]["username"].value;
            var password = document.forms["editProfile"]["password"].value;
            var email = document.forms["editProfile"]["email"].value;
            
            var namaValid = true;
            if (nama==="") {
                document.getElementById("nama-input").style.border = "1px solid #FF5252";
                var error = "Nama belum diisi";
                var element = document.getElementById("error-nama");
                element.innerHTML = error;
                namaValid = false;
            }else{
                document.getElementById("nama-input").style.border = "none";
                var element = document.getElementById("error-nama");
                element.innerHTML = "";
                namaValid = true;
            }
            
            var usernameValid = true;
            if (username==="") {
                document.getElementById("username").style.border = "1px solid #FF5252";
                var error = "Nama pengguna belum diisi";
                var element = document.getElementById("error-username");
                element.innerHTML = error;
                usernameValid = false;
            }else{
                document.getElementById("username").style.border = "none";
                var element = document.getElementById("error-username");
                element.innerHTML = "";
                usernameValid = true;
            }
            
            var passwordValid = true;
            if (password==="") {
                document.getElementById("password").style.border = "1px solid #FF5252";
                var error = "Kata sandi belum diisi";
                var element = document.getElementById("error-password");
                element.innerHTML = error;
                passwordValid = false;
            }else{
                document.getElementById("password").style.border = "none";
                var element = document.getElementById("error-password");
                element.innerHTML = "";
                passwordValid = true;
            }
            
            var emailValid = true;
            if (email==="") {
                document.getElementById("email").style.border = "1px solid #FF5252";
                var error = "Email belum diisi";
                var element = document.getElementById("error-email");
                element.innerHTML = error;
                emailValid = false;
            }else{
                document.getElementById("email").style.border = "none";
                var element = document.getElementById("error-email");
                element.innerHTML = "";
                emailValid = true;
            }

            if(!namaValid || !usernameValid || !passwordValid || !emailValid){
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
                <h1>Ubah Profil</h1>
                <a href="index.php"><button><i class="fas fa-angle-left"></i> Kembali</button></a>
            </div>
            <div class="kotak">
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="grup-input" onclick="$(this).hide()">
                <div class="error-box"><?php echo $_SESSION['error']; ?></div>
                </div>
            <?php unset($_SESSION['error']);} ?>
            <?php if(isset($_SESSION['great'])){ ?>
                <div class="grup-input" onclick="$(this).hide()">
                <div class="success-box"><?php echo $_SESSION['great']; ?></div>
                </div>
            <?php unset($_SESSION['great']);} ?>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" id="editProfile">
                <div class="grup-input">
                    <input type="text" name="nama" id="nama-input" placeholder="Nama" value="<?php echo $user['Name']; ?>">
                    <div class="error-msg" id="error-nama"></div>
                </div>
                <div class="grup-input">
                    <input type="text" name="username" id="username" placeholder="Nama Pengguna" value="<?php echo $user['Username']; ?>">
                    <div class="error-msg" id="error-username"></div>
                </div>
                <div class="grup-input">
                    <input type="password" name="password" id="password" placeholder="Kata Sandi lama jika tidak ingin mengubah">
                    <div class="error-msg" id="error-password"></div>
                </div>
                <div class="grup-input">
                    <input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $user['Email']; ?>">
                    <div class="error-msg" id="error-email"></div>
                </div>
                <div class="grup-input">
                    <input type="file" name="gambar" accept="image/*">
                </div>
                <div class='grup-input'>
                <button name='folder_button' id='folder_button' type="submit"><i class='fas fa-pencil-alt'></i> Ubah Profil</button>

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