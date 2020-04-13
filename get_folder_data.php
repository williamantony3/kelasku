<?php
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
        $output = "<button id='create_folder'>Folder Baru</button>";
        $output .= "
            <table class='table table-bordered table-striped'>
                <tr>
                    <th>Nama Folder / Berkas</th>
                    <th colspan='4' width='40%'>Aksi</th>
                </tr>
        ";
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
                    $output .= "
                    <tr>
                        <td><i class='fas fa-folder'></i> ".$file."</td>
                        <td><button name='update' data-name='".$file."' class='update'><i class='fas fa-edit'></i> Ubah Nama</button></td>
                        <td><button name='delete' data-name='".$file."' class='konfirmasi-box'><i class='fas fa-trash'></i> Hapus</button></td>
                        <td><button name='upload' data-name='".$file."' class='upload'><i class='fas fa-upload'></i> Unggah</button></td>
                        <td><button name='view_files' data-name='".$file."' class='view_files'><i class='fas fa-eye'></i> Lihat</button></td>
                    </tr>
                    ";
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
            <p>Enter Folder Name 
                <input type='text' name='folder_name' id='folder_name'>
            </p><br><br>
            <input type='hidden' name='action' id='action' value='create'>
            <input type='hidden' name='old_name' id='old_name'>
            <button name='folder_button' id='folder_button'>Buat Folder</button>
        ";
        echo $output;
    }
    if($_POST['action'] == "show update folder view"){
        $output = "
            <p>Enter Folder Name 
                <input type='text' name='folder_name' id='folder_name' value='".$_POST['folder_name']."'>
            </p><br><br>
            <input type='hidden' name='action' id='action' value='change'>
            <input type='hidden' name='old_name' id='old_name' value='".$_POST['folder_name']."'>
            <button name='folder_button' id='folder_button'>Ubah Nama</button>
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
        $output = "
            <table class='table table-bordered tabel-striped'>
                <tr>
                    <th>Nama Berkas</th>
                    <th>Unduh</th>
                    <th>Hapus</th>
                </tr>
        ";
        if(count($file_data)!=2){
            foreach($file_data as $file){
                if($file === "." OR $file === ".."){
                    continue;
                }else{
                    $path = "materials/" . $_POST['folder_name'] . "/" . $file;
                    $output .= "
                        <tr>
                            <td contenteditable='true' data-folder_name='".$_POST['folder_name']."' data-file_name='".$file."' class='change_file_name'>".$file."</td>
                            <td>Unduh</td>
                            <td><button name='remove_file' class='remove_file btn btn-danger btn-xs' id='".$path."'>Remove</button></td>
                        </tr>
                    ";
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
        $old_name = $_POST['folder_name'] . "/" . $_POST['old_file_name'];
        $new_name = $_POST['folder_name'] . "/" . $_POST['new_file_name'];
        if(rename($old_name, $new_name)){
            echo "File name udah diubah";
        }else{
            echo "error";
        }
    }
}
?>