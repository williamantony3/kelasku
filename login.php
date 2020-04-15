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
            echo "salah";
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
            <form action="" method="post">
                <div class="grup-input">
                    <input type="text" name="username" required="required" placeholder="Nama Pengguna">
                </div>
                <div class="grup-input">
                    <input type="password" name="password" required="required" placeholder="Kata Sandi">
                </div>
                <div class="grup-input">
                    <button type="submit">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>