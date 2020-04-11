<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbName = "kelasku";
    $target_dir = "C:/xampp/htdocs/kelasku/uploads/";
    $uploadOk = 1;

    $conn = mysqli_connect($host, $user, $pass, $dbName);
    
    if(isset($_POST["submit"])){
       $path = $_POST["subject"];
       $target_dir.=$path.="/"; //bikin path sesuai subject
       $NIM = $_POST["nimValidated"];
       $filename = $NIM."-".$_FILES["file"]["name"];
       $target_file = $target_dir . basename($filename);//ini filename; 
       $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));//dapetin file type
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["file"]["size"] > 1500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    $allowedfiles = array('jpg', 'png', 'jpeg', 'zip', 'xlsx', 'docx', 'pptx', 'pdf');
    // Allow certain file formats
    if(!in_array($imageFileType, $allowedfiles)) {
        echo $imageFileType;
        echo "Sorry, only JPG, JPEG, PNG, ZIP, XLSX, DOCX, PPTX, PDF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            if(mysqli_query($conn, "INSERT INTO `file` (`FileID`, `FileName`, `Path`) VALUES (NULL, '$filename', '$target_file') ")){
                echo "The file ". basename($filename). " has been uploaded.";
            } //bikin fileID
            $temp = 0;
            // echo $filename;
            $result = mysqli_query($conn, "SELECT * FROM `file` WHERE `FileName` LIKE '$filename' "); //dapetin data file
            if(mysqli_num_rows($result)>0){
                while($row = mysqli_fetch_array($result)){
                $temp = $row["FileID"];//ambil ID nya
                echo $temp;
                }
            }
            date_default_timezone_set("Asia/Jakarta");
            $date = date("Y-m-d h:i:s");
            if(mysqli_query($conn, "INSERT INTO `filehistory` (`FileID`, `NIM`, `UploadTime`, `ActionType`) VALUES ('$temp', '$NIM', '$date', '0')")){
                echo "With NIM " . $NIM ."File ID " . $temp;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }  
?>