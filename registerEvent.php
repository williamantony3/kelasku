<!-- registerEvent.php ini buat submit event yg baru -->
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "kelasku";

    $conn = mysqli_connect($host, $user, $pass, $dbName);
    
    if(isset($_POST['submit'])){
        $EventTitle = $_POST['EventTitle'];
        $startDate = $_POST['StartDate'];
        $EndDate = $_POST['EndDate'];
        $Place = $_POST['Place'];
        $Note= $_POST['Note'];
        // $checkbox = array();
        $checkbox1=$_POST['listNIM'];  
        $chk="";  
        
        mysqli_query($conn, "INSERT INTO `event` (`EventID`, `EventTitle` ,`StartDate`, `EndDate`, `Place`, `Note`) VALUES (NULL,'$EventTitle', '$startDate', '$EndDate', '$Place', '$Note')");
        echo "Event Sudah Berhasil diSubmit";
        $result = mysqli_query($conn, "SELECT * FROM `event` WHERE `EventTitle` LIKE '$EventTitle' AND `StartDate` = '$startDate'");
        // echo (mysqli_num_rows($result));
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_array($result)){
            $temp = $row["EventID"];//ambil ID nya
            foreach($checkbox1 as $cb){
                mysqli_query($conn, "INSERT INTO `eventdetail` (`EventID`, `NIM`) VALUES ('$temp', '$cb')");
            }
            }
        }
    }
    
?>