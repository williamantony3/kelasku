<!-- getNIM.php -->
<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "kelasku";

    $conn = mysqli_connect($host, $user, $pass, $dbName);
    $output="";
    $result = mysqli_query($conn, "SELECT * FROM `user` WHERE `NIM` LIKE '%" .$_POST["search"]. "%' ");

    if(mysqli_num_rows($result) > 0){
        $output.= '<select id="nim-select" name="nimValidated">';
        while($row = mysqli_fetch_array($result)){
            $output .= '<option value='.$row["NIM"].'>'.$row["NIM"].'</option>';
        }
        $output .= '</select>';
        echo $output;
    } else{
        echo 'NIM Not Found';
    }

?>