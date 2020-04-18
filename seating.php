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
                    <a href="turn-in.php"><div class="menu-item"><i class="fas fa-edit"></i> Kumpul Tugas</div></a>
                    <a href="materials.php"><div class="menu-item"><i class="fas fa-book"></i> Materi Kuliah</div></a>
                    <a href="seating.php"><div class="menu-item selected"><i class="fas fa-chair"></i> Cek Kursi</div></a>
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
                <a href="random.php"><button>Ya</button></a>
                <button class="cancel">Tidak</button>
            </div>
        </div>
    </div>
    <div class="container">
        <section>
            <div class="judul-section">
                <h1>Cek Kursi</h1>
                <?php if($_SESSION['Role'] == 1){ ?>
                <button class="konfirmasi-box"><i class="fas fa-retweet"></i> Acak Kursi</button>
                <?php } ?>
            </div><?php if(isset($_SESSION['error'])){ ?>
                <div class="grup-input" onclick="$(this).hide()">
                <div class="error-box"><?php echo $_SESSION['error']; ?></div>
                </div>
            <?php unset($_SESSION['error']);} ?><?php if(isset($_SESSION['great'])){ ?>
                <div class="grup-input" onclick="$(this).hide()">
                <div class="success-box"><?php echo $_SESSION['great']; ?></div>
                </div>
            <?php unset($_SESSION['great']);} ?>
            <div class="kotak">
                <!-- Kamu duduk di antara <?php siapaNomor($user['SeatNumber']-1); ?> dan <?php siapaNomor($user['SeatNumber']+1); ?> -->
                <div id="tempatduduk">
                    <!-- Baris 1 -->
                    <div class="duduk"><?php siapaNomor(1); ?></div>
                    <div class="duduk"><?php siapaNomor(2); ?></div>
                    <div class="duduk"><?php siapaNomor(3); ?></div>
                    <div class="duduk"><?php siapaNomor(4); ?></div>
                    <div class="duduk"><?php siapaNomor(5); ?></div>
                    <div class="duduk"><?php siapaNomor(6); ?></div>
                    <div class="duduk"><?php siapaNomor(7); ?></div>
                    <div class="duduk"><?php siapaNomor(8); ?></div>
                    <div class="kosong"></div>
                    <div class="duduk"><?php siapaNomor(9); ?></div>
                    <div class="duduk"><?php siapaNomor(10); ?></div>
                    <div class="duduk"><?php siapaNomor(11); ?></div>
                    <div class="duduk"><?php siapaNomor(12); ?></div>
                    <!-- Baris 2 -->
                    <div class="duduk"><?php siapaNomor(13); ?></div>
                    <div class="duduk"><?php siapaNomor(14); ?></div>
                    <div class="duduk"><?php siapaNomor(15); ?></div>
                    <div class="duduk"><?php siapaNomor(16); ?></div>
                    <div class="duduk"><?php siapaNomor(17); ?></div>
                    <div class="duduk"><?php siapaNomor(18); ?></div>
                    <div class="duduk"><?php siapaNomor(19); ?></div>
                    <div class="duduk"><?php siapaNomor(20); ?></div>
                    <div class="kosong"></div>
                    <div class="duduk"><?php siapaNomor(21); ?></div>
                    <div class="duduk"><?php siapaNomor(22); ?></div>
                    <div class="duduk"><?php siapaNomor(23); ?></div>
                    <div class="duduk"><?php siapaNomor(24); ?></div>
                    <!-- Baris 3 -->
                    <div class="kosong"></div>
                    <div class="duduk"><?php siapaNomor(25); ?></div>
                    <div class="duduk"><?php siapaNomor(26); ?></div>
                    <div class="duduk"><?php siapaNomor(27); ?></div>
                    <div class="duduk"><?php siapaNomor(28); ?></div>
                    <div class="duduk"><?php siapaNomor(29); ?></div>
                    <div class="duduk"><?php siapaNomor(30); ?></div>
                    <div class="duduk"><?php siapaNomor(31); ?></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <!-- Baris 4 -->
                    <div class="kosong"></div>
                    <div class="duduk"><?php siapaNomor(32); ?></div>
                    <div class="duduk"><?php siapaNomor(33); ?></div>
                    <div class="duduk"><?php siapaNomor(34); ?></div>
                    <div class="duduk"><?php siapaNomor(35); ?></div>
                    <div class="duduk"><?php siapaNomor(36); ?></div>
                    <div class="duduk"><?php siapaNomor(37); ?></div>
                    <div class="duduk"><?php siapaNomor(38); ?></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <!-- Baris 5 -->
                    <div class="kosong"></div>
                    <div class="duduk"><?php siapaNomor(44); ?></div>
                    <div class="duduk"><?php siapaNomor(45); ?></div>
                    <div class="duduk"><?php siapaNomor(39); ?></div>
                    <div class="duduk"><?php siapaNomor(40); ?></div>
                    <div class="duduk"><?php siapaNomor(41); ?></div>
                    <div class="duduk"><?php siapaNomor(42); ?></div>
                    <div class="duduk"><?php siapaNomor(43); ?></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                    <div class="kosong"></div>
                </div>
                
            </div>  
            <footer>
                2020 &copy; CIH!
            </footer>
        </section>
    </div>
<?php include "footer.php"; ?>