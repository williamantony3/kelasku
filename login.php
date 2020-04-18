<?php
    session_start();
    require_once "config.php";
    if(isset($_SESSION['NIM'])){
        header("Location: index.php");
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $query = mysqli_query($conn, "SELECT * FROM user WHERE Username='$username' AND Password='$password'");
        if(mysqli_num_rows($query) == 1){
            $user = mysqli_fetch_assoc($query);
            $_SESSION['NIM'] = $user['NIM'];
            $_SESSION['Role'] = $user['Role'];
            header("Location: index.php");
        }else{
            $_SESSION['error'] = "Kombinasi Nama Pengguna dengan Kata Sandi tidak cocok";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Kelasku</title>
    <link rel="shortcut icon" href="./assets/images/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.12.1-web/css/all.css">
    <script src="./assets/scripts/jquery-3.4.1.min.js"></script>
    <script src="get_absen_data.js"></script>
    <script>
        function validateForm() {
            var username = document.forms["loginForm"]["username"].value;
            var password = document.forms["loginForm"]["password"].value;

            var usernameValid = true;
            if (username=== "") {
                document.getElementById("username").style.border = "1px solid #FF5252";
                var error = "Nama Pengguna belum diisi";
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
            if (password=== "") {
                document.getElementById("password").style.border = "1px solid #FF5252";
                var error = "Kata Sandi belum diisi";
                var element = document.getElementById("error-password");
                element.innerHTML = error;
                passwordValid = false;
            }else{
                document.getElementById("password").style.border = "none";
                var element = document.getElementById("error-password");
                element.innerHTML = "";
                usernameValid = true;
            }

            if(!usernameValid || !passwordValid){
                return false;
            }
        }
    </script>
</head>
<body>
    <div id="login-page">
        <div id="login-page-kiri">
            <h3>Yang Masih Belum Absen Hari Ini</h3>
            <table>
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                    </tr>
                </thead>
                <tbody id="div_absen">

                </tbody>
            </table>
        </div>
        <div id="login-page-kanan">
            <h2>Masuk Kelasku</h2>
            <?php if(isset($_SESSION['error'])){ ?>
                <div class="grup-input" onclick="$(this).hide()">
                <div class="error-box"><?php echo $_SESSION['error']; ?></div>
                </div>
            <?php unset($_SESSION['error']);} ?>
            <form action="" method="post" name="loginForm" onsubmit="return validateForm()">
                <div class="grup-input">
                    <input type="text" name="username" placeholder="Nama Pengguna" id="username">
                    <div class="error-msg" id="error-username"></div>
                </div>
                <div class="grup-input">
                    <input type="password" name="password" placeholder="Kata Sandi" id="password">
                    <div class="error-msg" id="error-password"></div>
                </div>
                <div class="grup-input">
                    <button type="submit">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>