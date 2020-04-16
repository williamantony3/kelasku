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

    include "header.php"; 
?>
    <nav>
        <div class="container space-between">
            <div id="nav-kiri">
                <div id="logo-kelas">
                    <img src="./assets/images/icon.jpg" alt="">
                </div>
                <div id="menu">
                    <a href="index.php"><div class="menu-item"><i class="fas fa-home"></i> Beranda</div></a>
                    <a href="turn-in.php"><div class="menu-item selected"><i class="fas fa-edit"></i> Kumpul Tugas</div></a>
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
                <h1>Kumpul Tugas</h1>
                <?php if($_SESSION['Role'] == 1){ ?>
                <button id='create_folder'><i class="fas fa-folder-plus"></i> Buat Folder Pengumpulan</button>
                <?php } ?>
                <button id="up"><i class="fas fa-angle-left"></i> Kembali</button>
            </div>
            <div class="kotak">
            </div>  
            <footer>
                2020 &copy; CIH!
            </footer>
        </section>
    </div>
    <script src="get_tugas_data.js"></script>
<?php include "footer.php"; ?>