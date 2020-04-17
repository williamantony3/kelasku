<?php
    session_start();
    require_once "config.php";
    if(!isset($_SESSION['NIM'])){
        header("Location: login.php");
    }
    $nim = $_SESSION['NIM'];
    $queryUser = mysqli_query($conn, "SELECT * FROM user WHERE NIM='$nim'");
    $user = mysqli_fetch_assoc($queryUser);
    $queryPost = mysqli_query($conn, "SELECT * FROM post INNER JOIN user ON post.NIM = user.NIM ORDER BY ID DESC");
    $queryAcara = mysqli_query($conn, "SELECT * FROM event WHERE Date >= CURRENT_TIMESTAMP");
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
                    0
                </div>
                mahasiswa belum absen hari ini
                <a href="presence_list.php"><div id="siapa-aja"><i class="fas fa-eye"></i> Siapa tuh?</div></a>
            </div>
        </div>
        <div id="postingan-utama">
            <?php while($rowPost = mysqli_fetch_assoc($queryPost)){
                if($rowPost['Type'] == 0){
                    if(!file_exists($rowPost['Content'])){
                        continue;
                    }
            ?>
            <div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/account.png" alt="" srcset="">
                    </div>
                    <div class="yang-post-kanan">
                        <div class="nama-ts">
                            <?php echo $rowPost['Name']; ?>
                        </div>
                        <div class="waktu-post">
                            <?php echo $rowPost['Time']; ?>
                        </div>
                    </div>
                </div>
                <div class="isi-post">
                    <?php echo $rowPost['Message']; ?>
                </div>
                <a href="<?php echo $rowPost['Content']; ?>"><div class="materi-item"><i class="fas fa-file"></i> <?php echo $rowPost['Content']; ?></div></a>
            </div>
            <?php 
                }elseif ($rowPost['Type'] == 1) {
                    $idAcara = $rowPost['Content'];
                    $resAcaraPost = mysqli_query($conn, "SELECT * FROM event WHERE ID='$idAcara'");
                    $rowAcaraPost = mysqli_fetch_assoc($resAcaraPost);
            ?>
                <div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/account.png" alt="" srcset="">
                    </div>
                    <div class="yang-post-kanan">
                        <div class="nama-ts">
                            <?php echo $rowPost['Name']; ?>
                        </div>
                        <div class="waktu-post">
                            <?php echo $rowPost['Time']; ?>
                        </div>
                    </div>
                </div>
                <div class="isi-post">
                    <?php echo $rowPost['Message']; ?>
                </div>
                <a href="detail_acara.php?id=<?php echo $rowPost['Content']; ?>"><div class="materi-item"><i class="fas fa-calendar"></i> <?php echo $rowAcaraPost['Name']; ?><br><?php echo $rowAcaraPost['Date']; ?> di <?php echo $rowAcaraPost['Place']; ?></div></a>
            </div>
            <?php
                }
            } 
            ?>
            <footer>
                    2020 &copy; CIH!
            </footer>
        </div>
        <div id="sidebar-kanan">
            <div id="waktu">
                <div id="tanggal"></div>
                <div id="jam"></div>
                <?php if(mysqli_num_rows($queryAcara) == 0){ ?>
                    <div class="acara-item">
                        <div class="judul-acara">Tidak ada acara</div>
                    </div>
                <?php }else{ ?>
                <?php while($rowAcara = mysqli_fetch_assoc($queryAcara)){ ?>
                <a href="detail_acara.php?id=<?php echo $rowAcara['ID']; ?>" style="color: white;">
                <div class="acara-item">
                    <div class="acara-kiri">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="acara-kanan">
                        <div class="judul-acara">
                            <?php echo $rowAcara['Name']; ?>
                        </div>
                        <div class="detail-acara">
                            <?php echo $rowAcara['Date'] . " " . $rowAcara['Time']; ?>, <?php echo $rowAcara['Place']; ?>
                        </div>
                    </div>
                </div>
                </a>
                <?php } }?>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            // console.log("jquery masuk");
            setInterval(function(){
                $('#jumlah-orang').load("get_jumlah_belum_absen_data.php").fadeIn();
                $('#status-absen').load("get_status_absen_data.php").fadeIn();
            }, 1000);
        });
    </script>
<?php include "footer.php"; ?>