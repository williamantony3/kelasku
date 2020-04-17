<!-- getNIM.php ini php buat dapetin semua data NIM orang-->
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "kelasku";

    $conn = mysqli_connect($host, $user, $pass, $dbName);
    $output="";
    $result = mysqli_query($conn, "SELECT * FROM `user`");

    if(mysqli_num_rows($result) > 0){
        $output.= '<input type="checkbox" onClick="selectAll(this)"/> Select All <br/>';
        while($row = mysqli_fetch_array($result)){
            $output .= '<input type="checkbox" class="checkboxNIM" name="listNIM" value='.$row["NIM"].'>'.$row["NIM"].'<br/>';
        }
        echo $output;
    } else{
        echo 'NIM Not Found';
    }

?>