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
                    <a href="index.php"><div class="menu-item selected"><i class="fas fa-home"></i> Beranda</div></a>
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
                    <img src="./assets/images/account.png" alt="">
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id="sidebar-kiri">
            <div id="ucapan">
                <div id="ucapan-orang">
                    Halo, <?php echo $user['Name']; ?>!
                </div>
                <div id="status-absen">
                    <span class="belum-absen">Belum Absen</span>
                </div>
                <div id="data-diri">
                    <div class="data-diri-header">NIM</div>
                    <?php echo $user['NIM']; ?>
                    <div class="data-diri-header">E-mail</div>
                    <?php echo $user['Email']; ?>
                </div>
            </div>
            <div id="status-kelas">
                <div id="jumlah-orang">
                    3
                </div>
                temanmu belum absen
                <a href="index.php"><div id="siapa-aja"><i class="fas fa-eye"></i> Siapa tuh?</div></a>
            </div>
        </div>
        <div id="postingan-utama">
            <div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/account.png" alt="" srcset="">
                    </div>
                    <div class="yang-post-kanan">
                        <div class="nama-ts">
                            William Antony
                        </div>
                        <div class="waktu-post">
                            17:09, 4 April 2020
                        </div>
                    </div>
                </div>
                <div class="isi-post">
                    Gais ada materi baru nih gais!
                </div>
                <a href=""><div class="materi-item"><i class="fas fa-file"></i> Materi.pdf</div></a>
            </div>
            
            <footer>
                    2020 &copy; CIH!
            </footer>
        </div>
        <div id="sidebar-kanan">
            <div id="waktu">
                <div id="tanggal"></div>
                <div id="jam"></div>
                
                <div class="acara-item">
                    <div class="acara-kiri">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="acara-kanan">
                        <div class="judul-acara">
                            Tukar Kado
                        </div>
                        <div class="detail-acara">
                            17:30 WIB, Ruang A801
                        </div>
                    </div>
                </div>
                
                <div class="acara-item">
                    <div class="acara-kiri">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="acara-kanan">
                        <div class="judul-acara">
                            Tukar Kado
                        </div>
                        <div class="detail-acara">
                            17:30 WIB, Ruang A801
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include "footer.php"; ?>