<!-- absen_data.php -->
<?php
    include "config.php";
    //  $host = "localhost";
    //  $user = "root";
    //  $pass = "";
    //  $dbName = "kelasku";
    $output = '';
    //  $output1= '';

    //  $today = date("Y-m-d");
    //  echo $today;
    //  $conn = mysqli_connect($host, $user, $pass, $dbName);
    //  $result = mysqli_query($conn, "SELECT * FROM absendetail A JOIN user U WHERE  DATE(`Date`) = CURDATE()  AND A.NIM=U.NIM AND AbsenTime IS NULL");
    //  $result2 = mysqli_query($conn, "SELECT * FROM absendetail A JOIN user U WHERE DATE(`Date`) = CURDATE()  AND A.NIM=U.NIM AND AbsenTime > '08:00:00'");
     $semua = mysqli_query($conn, "SELECT * FROM user ORDER BY Name ASC");
     
    //  if(mysqli_num_rows($result)>0){
        // $output .= '<h4>Yang Belum Absen</h4>';
        // $output .= '<div class="absen_container">
        //                    <table border="1" class="absen_table">
        //                        <tr>
        //                            <th>Nama</th>
        //                            <th>Waktu Absen</th>
        //                        </tr>
        //                    </table>
        //                </div>';
        $i = 0;
        while($row = mysqli_fetch_array($semua)){
            // echo '<p>'.$row["NIM"].'</p>';
            $nim = $row['NIM'];
            $cari = mysqli_query($conn, "SELECT * FROM absendetail WHERE NIM='$nim' AND Date = CURDATE()");
            if(mysqli_num_rows($cari) == 0){
                ++$i;
            }
        };
        $output = $i;
        echo $output;
    // }
    // if(mysqli_num_rows($result2)>0){
    //     $output1 .= '<h4>Telat</h4>';
    //     $output1 .= '<div class="absen_container">
    //                        <table border="1" class="absen_table">
    //                            <tr>
    //                                <th>Nama</th>
    //                                <th>Waktu Absen</th>
    //                            </tr>
    //                        </table>
    //                    </div>';
    //     while($row = mysqli_fetch_array($result2)){
    //         // echo '<p>'.$row["NIM"].'</p>';
    //         $output1 .= '<tr>
    //                         <td>'.$row['Name'].'</td>
    //                         <td>'.$row["AbsenTime"].'</td>
    //                     </tr> <br>' ;
    //     }
    //     echo $output1;
    // }    else {
    //     echo "Everyone has absen";
    // }

?>