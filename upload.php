<?php
session_start();
require_once "config.php";
if($_FILES['upload_file']['name'] != ""){
    $data = explode(".", $_FILES['upload_file']['name']);
    $extension = $data[1];
    $allowed_extension = array("jpg", "png", "gif", "pdf", "doc", "docx", "zip", "rar", "ppt", "pptx", "xls", "xlsx", "DOCX", "PPTX", "XLSX", "jpeg");
    if(in_array($extension, $allowed_extension)){
        // $new_file_name = rand() . "." . $extension;
        $path = "materials/".$_POST['hidden_folder_name'] . "/" . $_FILES['upload_file']['name'];
        if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $path)){
            $path = "materials/".$_POST['hidden_folder_name'] . "/" . $_FILES['upload_file']['name'];
            $nim = $_SESSION['NIM'];
            $msg = $_POST['pesan'];
            mysqli_query($conn, "INSERT INTO post(NIM, Message, Type, Content) VALUES ('$nim', '$msg', 0, '$path')");
            mysqli_query($conn, "INSERT INTO file(Path, NIM) VALUES ('$path', '$nim')");
            $_SESSION['great'] = "Aksi berhasil";
        }else{
            $_SESSION['error'] = "Kesalahan saat unggah berkas";
        }
    }else{
        $_SESSION['error'] = "Ekstensi berkas tidak didukung";
    }
}else{
    echo "Please select image";
}
?>