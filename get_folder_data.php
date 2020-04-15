<?php
session_start();
require_once "config.php";
function format_folder_size($size){
    if($size >= 1073741824){
        $size = number_format($size / 1073741824, 2) . " GB";
    }elseif($size >= 1048576){
        $size = number_format($size / 1048576, 2) . " MB";
    }elseif($size >= 1024){
        $size = number_format($size / 1024, 2) . " KB";
    }elseif($size > 1){
        $size = $size . " bytes";
    }elseif($size = 1){
        $size = $size . " byte";
    }else{
        $size = "0 byte";
    }
    return $size;
}
function get_folder_size($folder_name){
    $total_size = 0;
    $file_data = scandir($folder_name);
    foreach($file_data as $file){
        if($file === "." OR $file === ".."){
            continue;
        }else{
            $path = $folder_name . "/" . $file;
            $total_size = $total_size + filesize($path);
        }
    }
    return format_folder_size($total_size);
}
if(isset($_POST['action'])){
    if($_POST['action'] == "fetch"){
        // $sorted = array();
        $file_data = scandir("materials/");
        natcasesort($file_data);
        // $file_data = array_filter("materials/".$file_data, 'is_dir');
        // $output = "<button id='create_folder'>Folder Baru</button>";
        if($_SESSION['Role'] == 1){
            $output = "
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th>Nama Folder / Berkas</th>
                        <th colspan='4' width='40%'>Aksi</th>
                    </tr>
            ";
        }else{
            $output = "
                <table class='table table-bordered table-striped'>
                    <tr>
                        <th>Nama Folder / Berkas</th>
                        <th colspan='2' width='20%'>Aksi</th>
                    </tr>
            ";
        }
        if(count($file_data)>0){
            foreach($file_data as $file){
                if($file === "." || $file === ".."){
                    continue;
                }else{
                    // if(is_dir("materials/".$file)){
                    //     array_unshift($sorted, "
                    //         <tr>
                    //             <td><i class='fas fa-folder'></i> ".$file."</td>
                    //             <td><button type='button' name='update' data-name='".$file."' class='update btn btn-warning btn-xs'><i class='fas fa-edit'></i> Ubah Nama</button></td>
                    //             <td><button type='button' name='delete' data-name='".$file."' class='delete btn btn-danger btn-xs'><i class='fas fa-trash'></i> Hapus</button></td>
                    //             <td><button type='button' name='upload' data-name='".$file."' class='upload btn btn-info btn-xs'><i class='fas fa-upload'></i> Unggah</button></td>
                    //             <td><button type='button' name='view_files' data-name='".$file."' class='view_files btn btn-default btn-xs'><i class='fas fa-eye'></i> Lihat</button></td>
                    //         </tr>
                    //     ");
                    // }else{
                    //     array_push($sorted, "
                    //         <tr>
                    //             <td><i class='fas fa-file'></i> ".$file."</td>
                    //             <td><button type='button' name='update' data-name='".$file."' class='update btn btn-warning btn-xs'><i class='fas fa-edit'></i> Ubah Nama</button></td>
                    //             <td><button type='button' name='delete' data-name='".$file."' class='konfirmasi-box btn btn-danger btn-xs'><i class='fas fa-trash'></i> Hapus</button></td>
                    //             <td>&nbsp;</td>
                    //             <td>&nbsp;</td>
                    //         </tr>
                    //     ");
                    // }
                    if($_SESSION['Role'] == 1){
                        $output .= "
                        <tr>
                            <td><i class='fas fa-folder'></i> ".$file."</td>
                            <td><button name='update' data-name='".$file."' class='update'><i class='fas fa-edit'></i> Ubah Nama</button></td>
                            <td><button name='delete' data-name='".$file."' class='konfirmasi-box'><i class='fas fa-trash'></i> Hapus</button></td>
                            <td><button name='upload' data-name='".$file."' class='upload'><i class='fas fa-upload'></i> Unggah</button></td>
                            <td><button name='view_files' data-name='".$file."' class='view_files'><i class='fas fa-eye'></i> Lihat</button></td>
                        </tr>
                        ";
                    }else{
                        $output .= "
                        <tr>
                            <td><i class='fas fa-folder'></i> ".$file."</td>
                            <td><button name='upload' data-name='".$file."' class='upload'><i class='fas fa-upload'></i> Unggah</button></td>
                            <td><button name='view_files' data-name='".$file."' class='view_files'><i class='fas fa-eye'></i> Lihat</button></td>
                        </tr>
                        ";
                    }
                }
            }
            // foreach ($sorted as $sortedItem) {
            //     $output .= $sortedItem;
            // }
        }else{
            $output .= "
                <tr>
                    <td colspan='6'>Tidak ada berkas</td>
                </tr>
            ";
        }
        $output .= "</table>";
        echo $output;
    }
    if($_POST['action'] == "show create folder view"){
        $output = "
            <div class='grup-input'>
                <input type='text' name='folder_name' id='folder_name' placeholder='Nama Folder' required>
            <input type='hidden' name='action' id='action' value='create'>
            <input type='hidden' name='old_name' id='old_name'>
            </div>
            <div class='grup-input'>
            <button name='folder_button' id='folder_button'><i class='fas fa-folder-plus'></i> Buat Folder</button>
            </div>
        ";
        echo $output;
    }
    if($_POST['action'] == "show update folder view"){
        $output = "
            <div class='grup-input'>
                <input type='text' name='folder_name' id='folder_name' value='".$_POST['folder_name']."' placeholder='Nama Folder' required>
            </div>
            <input type='hidden' name='action' id='action' value='change'>
            <input type='hidden' name='old_name' id='old_name' value='".$_POST['folder_name']."'>
            <div class='grup-input'>
            <button name='folder_button' id='folder_button'><i class='fas fa-edit'></i> Ubah Nama</button>
            </div>
        ";
        echo $output;
    }
    if($_POST['action'] == "show upload form"){
        $output = "
            <form action='' method='post' enctype='multipart/form-data' id='upload_form'>
            <div class='grup-input'>
                <textarea rows='10' cols='30' placeholder='Ketik pesanmu' name='pesan'></textarea>
                <input type='hidden' name='hidden_folder_name' id='hidden_folder_name' value='".$_POST['folder_name']."'>
            </div>
            <div class='grup-input'>
                <input type='file' name='upload_file'>
            </div>
            <div class='grup-input'>
                <button type='submit'><i class='fas fa-upload'></i> Unggah</button>
            </div>
            </form>
        ";
        echo $output;
    }
    if($_POST['action'] == "create"){
        if(!file_exists("materials/".$_POST['folder_name'])){
            mkdir("materials/".$_POST['folder_name'], 0777, true);
            echo "Folder created";
        }else{
            echo "Folder already created";
        }
    }
    if($_POST['action'] == "change"){
        if(!file_exists("materials/".$_POST['folder_name'])){
            rename("materials/".$_POST['old_name'], "materials/".$_POST['folder_name']);
            echo "Folder name changed";
        }else{
            echo "Folder already created";
        }
    }
    if($_POST['action'] == "fetch_files"){
        $file_data = scandir("materials/".$_POST['folder_name']);
        natcasesort($file_data);
        if($_SESSION['Role'] == 1){
            $output = "
                <table class='table table-bordered tabel-striped'>
                    <tr>
                        <th>Nama Berkas</th>
                        <th colspan='3' width='30%'>Aksi</th>
                    </tr>
            ";
        }else{
            $output = "
                <table class='table table-bordered tabel-striped'>
                    <tr>
                        <th>Nama Berkas</th>
                        <th colspan='1' width='10%'>Aksi</th>
                    </tr>
            ";
        }
        if(count($file_data)!=2){
            foreach($file_data as $file){
                if($file === "." OR $file === ".."){
                    continue;
                }else{
                    $path = "materials/" . $_POST['folder_name'] . "/" . $file;
                    if($_SESSION['Role'] == 1){
                        $output .= "
                            <tr>
                                <td data-folder_name='".$_POST['folder_name']."' class='change_file_name' data-folder_name='".$_POST['folder_name']."' data-file_name='".$file."' contenteditable='true' class='editable'>".$file."</td>
                                <td><button name='change_file_name' class='trigger_change_file_name' data-folder_name='".$_POST['folder_name']."' data-file_name='".$file."' ><i class='fas fa-edit'></i> Ubah Nama</button></td>
                                <td><button name='remove_file' class='konfirmasi-box-remove' id='".$path."'><i class='fas fa-trash'></i> Hapus</button></td>
                                <td><a href='".$path."'><button name='download' id='".$path."'><i class='fas fa-download'></i> Unduh</button></a></td>
                            </tr>
                        ";
                    }else{
                        $output .= "
                            <tr>
                                <td data-folder_name='".$_POST['folder_name']."' class='change_file_name' data-folder_name='".$_POST['folder_name']."' data-file_name='".$file."'  class='editable'>".$file."</td>
                                <td><a href='".$path."'><button name='download' id='".$path."'><i class='fas fa-download'></i> Unduh</button></a></td>
                            </tr>
                        ";
                    }
                }
            }
        }else{
            $output .=  "
                <tr>
                    <td colspan='3'>Tidak ada berkas</td>
                </tr>
            ";
        }
        $output .= "</table>";
            
    
        echo $output;
    }
    if($_POST['action'] == "remove_file"){
        if(file_exists($_POST['path'])){
            unlink($_POST['path']);
            echo "File deleted";
        }
    }
    if($_POST['action'] == "delete"){
        $file_data = scandir("materials/".$_POST['folder_name']);
        foreach($file_data as $file){
            if($file === "." OR $file === ".."){
                continue;
            }else{
                unlink("materials/".$_POST['folder_name'] . "/" . $file);
            }
        }
        if(rmdir("materials/".$_POST['folder_name'])){
            echo "Folder deleted";
        }
    }
    if($_POST['action'] == "change_file_name"){
        $old_name = "materials/" . $_POST['folder_name'] . "/" . $_POST['old_file_name'];
        $new_name = "materials/" . $_POST['folder_name'] . "/" . $_POST['new_file_name'];
        if(rename($old_name, $new_name)){
            mysqli_query($conn, "UPDATE post SET Content='$new_name' WHERE Content='$old_name'");
            echo "File name udah diubah";
        }else{
            echo "error";
        }
    }
}
?>