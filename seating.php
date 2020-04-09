<?php 
    include "config.php";
    if(!isset($_SESSION['NIM'])){
        header("Location: login.php");
    }
    $nim = $_SESSION['NIM'];
    $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE NIM='$nim'");
    $user = mysqli_fetch_assoc($queryUser);
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
                    <a href="index.php"><div class="menu-item"><i class="fas fa-edit"></i> Kumpul Tugas</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-book"></i> Materi Kuliah</div></a>
                    <a href="seating.php"><div class="menu-item selected"><i class="fas fa-chair"></i> Cek Kursi</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-calendar"></i> Acara Kelas</div></a>
                </div>
            </div>
            <div id="nav-kanan">
                <div id="nama">
                    <?php echo $user['Name']; ?>
                    <div id="dropdown-nav-kanan">
                        <a href="index.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-user"></i> Ubah Profil</div></a>
                        <a href="logout.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-sign-out-alt"></i> Keluar</div></a>
                    </div>
                </div>
                <div id="profil">
                    <img src="./assets/images/account.png" alt="">
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <section>
            <div class="kotak">
                <h1>Posisi Tempat Duduk di Kelas</h1>
                <!-- Baris 1 -->
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="kosong"></div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <!-- Baris 2 -->
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="kosong"></div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <!-- Baris 3 -->
                <div class="kosong"></div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <!-- Baris 4 -->
                <div class="kosong"></div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <div class="kosong"></div>
                <!-- Baris 5 -->
                <div class="kosong"></div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
                <div class="duduk">tes</div>
            </div>
            <footer>
                2020 &copy; CIH!
            </footer>
        </section>
    </div>
<?php include "footer.php"; ?>