<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelasku</title>
    <link rel="shortcut icon" href="./assets/images/icon.jpg" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./assets/fontawesome-free-5.12.1-web/css/all.css">
    <script src="./assets/scripts/jquery-3.4.1.min.js"></script>
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
</head>
<body onload="startTime()">
    <nav>
        <div class="container space-between">
            <div id="nav-kiri">
                <div id="logo-kelas">
                    <img src="./assets/images/icon.jpg" alt="">
                </div>
                <div id="menu">
                    <a href="index.php"><div class="menu-item selected"><i class="fas fa-home"></i> Beranda</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-edit"></i> Kumpul Tugas</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-book"></i> Materi Kuliah</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-chair"></i> Cek Kursi</div></a>
                    <a href="index.php"><div class="menu-item"><i class="fas fa-calendar"></i> Acara Kelas</div></a>
                </div>
            </div>
            <div id="nav-kanan">
                <div id="nama">
                    William Antony
                    <div id="dropdown-nav-kanan">
                        <a href="index.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-user"></i> Ubah Profil</div></a>
                        <a href="index.php"><div class="dropdown-nav-kanan-item"><i class="fas fa-sign-out-alt"></i> Keluar</div></a>
                    </div>
                </div>
                <div id="profil">
                    <img src="./assets/images/people.jpg" alt="">
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div id="sidebar-kiri">
            <div id="ucapan">
                <div id="ucapan-orang">
                    Halo, William Antony!
                </div>
                <div id="status-absen">
                    <span class="belum-absen">Belum Absen</span>
                </div>
                <div id="data-diri">
                    <div class="data-diri-header">NIM</div>
                    2201827673
                    <div class="data-diri-header">E-mail</div>
                    william.antony001@binus.ac.id
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
                        <img src="./assets/images/people.jpg" alt="" srcset="">
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
            </div><div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/people.jpg" alt="" srcset="">
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
            </div><div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/people.jpg" alt="" srcset="">
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
            </div><div class="postingan-item">
                <div class="yang-post">
                    <div class="foto-ts">
                        <img src="./assets/images/people.jpg" alt="" srcset="">
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
    <script src="script.js"></script>
</body>
</html>