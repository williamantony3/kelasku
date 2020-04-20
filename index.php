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
    $queryAcara = mysqli_query($conn, "SELECT * FROM event WHERE Date >= CURRENT_TIMESTAMP ORDER BY Date ASC");
    include "header.php"; 
?>
    <div id="konfirmasi">
        <div id="konfirmasi-box">
            <div id="konfirmasi-logo">
                <i class="fas fa-check-circle"></i>
            </div>
            <div id="konfirmasi-pesan">
                Kamu yakin ingin melanjutkan?
            </div>
            <div id="konfirmasi-button">
                <a id="deletepost"><button>Ya</button></a>
                <button class="cancel">Tidak</button>
            </div>
        </div>
    </div>
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
                
            <?php if(isset($_SESSION['error'])){ ?>
            <div class="postingan-item" onclick="$(this).hide()">
                <div class="error-box"><?php echo $_SESSION['error']; ?></div>
            </div>
            <?php unset($_SESSION['error']);} ?>
            <?php if(isset($_SESSION['great'])){ ?>
                
            <div class="postingan-item" onclick="$(this).hide()">
                <div class="success-box"><?php echo $_SESSION['great']; ?></div>
            </div>
            <?php unset($_SESSION['great']);} ?>
            <div class="postingan-item">
            <a href="create_post.php"><button style="width: 100%;"><i class='fas fa-pencil-alt'></i> Buat Postingan</button></a>
            </div>
            <?php while($rowPost = mysqli_fetch_assoc($queryPost)){
                $nimts = $rowPost['NIM'];
                $rests = mysqli_query($conn, "SELECT * FROM user WHERE NIM='$nimts'");
                $ts = mysqli_fetch_assoc($rests);
                if($rowPost['Type'] == 0){
                    if(!file_exists($rowPost['Content'])){
                        continue;
                    }
            ?>
            <div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <?php 
                        if(empty($ts['ProfilePicture'])){
                        ?>
                        <img src="./assets/images/account.png" alt="" srcset="">
                        <?php }else{ ?>
                        <img src="<?php echo $ts['ProfilePicture']; ?>" alt="" srcset="">
                        <?php }  ?>
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
                        <?php 
                        if(empty($ts['ProfilePicture'])){
                        ?>
                        <img src="./assets/images/account.png" alt="" srcset="">
                        <?php }else{ ?>
                        <img src="<?php echo $ts['ProfilePicture']; ?>" alt="" srcset="">
                        <?php }  ?>
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
                <a href="detail_acara.php?id=<?php echo $rowPost['Content']; ?>"><div class="materi-item" style="display: flex; flex-direction: row; align-items: center;">
                <div><i class="fas fa-calendar"></i></div>
                <div style="margin-left: 10px;"><?php echo $rowAcaraPost['Name']; ?><br><?php echo $rowAcaraPost['Date']; ?> di <?php echo $rowAcaraPost['Place']; ?></div>
                </div></a>
                </div>
            <?php
                }elseif ($rowPost['Type'] == 2) {
            ?>
                <div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <?php 
                        if(empty($ts['ProfilePicture'])){
                        ?>
                        <img src="./assets/images/account.png" alt="" srcset="">
                        <?php }else{ ?>
                        <img src="<?php echo $ts['ProfilePicture']; ?>" alt="" srcset="">
                        <?php }  ?>
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
                <div class="isi-post" style="text-align: justify;">
                    <?php echo $rowPost['Message']; ?>
                </div>
                    <?php if($_SESSION['Role'] == 1 || $_SESSION['NIM'] == $rowPost['NIM']){?>
                        <div class="post-setting">
                            <a href="update_post.php?id=<?php echo $rowPost['ID']; ?>"><i class="fas fa-edit"></i> Ubah</a>&nbsp;&nbsp;
                            <a style="cursor: pointer;" id="hapus-post" data-id="<?php echo $rowPost['ID']; ?>"><i class="fas fa-trash"></i> Hapus</a>
                        </div>
                    <?php } ?>
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
            $(document).on("click", "#hapus-post", function(){
                $("#konfirmasi").show("slow");
                var id = $(this).data("id");
                $("#deletepost").attr("href", "delete_post.php?id="+id);
            });
        });
    </script>
<?php include "footer.php"; ?>