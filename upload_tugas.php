<?php
session_start();
require_once "config.php";
if($_FILES['upload_file']['name'] != ""){
    $data = explode(".", $_FILES['upload_file']['name']);
    $extension = $data[1];
    $allowed_extension = array("zip");
    if(in_array($extension, $allowed_extension)){
        $new_file_name = $_SESSION['NIM'] . "." . $extension;
        $path = "assignments/".$_POST['hidden_folder_name'] . "/" . $new_file_name;
        if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $path)){
            echo $msg;
        }else{
            echo "There is some error";
        }
    }else{
        echo "Invalid extension";
    }
}else{
    echo "Please select image";
}
?>