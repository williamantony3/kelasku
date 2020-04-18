$(document).ready(function () {
    load_folder();
    function load_folder() {
        var action = "fetch";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action },
            success: function (data) {
                $(".kotak").html(data);
                // $(".judul-section").html("<h1>Materi Kuliah</h1><button id='create_folder'><i class='fas fa-folder-plus'></i> Buat Folder</button>");
                $("#create_folder").show();
                $("#up").hide()
            }
        });
    }
    $(document).on("click", "#up", function(){
        load_folder();
    });
    $(document).on("click", "#create_folder", function () {
        var action = "show create folder view";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action },
            success: function (data) {
                // $(".judul-section").html("<h1>Materi Kuliah</h1><button id='up'><i class='fas fa-angle-left'></i> Kembali</button>");
                $(".kotak").html(data);
                $("#up").show()
                $("#create_folder").hide();
            }
        });
    });
    $(document).on("focus", "#tanggal_kumpul", function(){
        $(this).attr("type", "date");
    });
    $(document).on("focus", "#waktu_kumpul", function(){
        $(this).attr("type", "time");
    });
    $(document).on("click", "#folder_button", function () {
        var folder_name = $("#folder_name").val();
        var action = $("#action").val();
        var old_name = $("#old_name").val();
        var tanggal_kumpul = $("#tanggal_kumpul").val();
        var waktu_kumpul = $("#waktu_kumpul").val();
        var tempat_kumpul = $("#tempat_kumpul").val();
        var catatan = $("#catatan").val();
        if (folder_name != "") {
            $.ajax({
                url: "get_tugas_data.php",
                method: "POST",
                data: { folder_name: folder_name, old_name: old_name, action: action, tanggal_kumpul: tanggal_kumpul, waktu_kumpul: waktu_kumpul, tempat_kumpul: tempat_kumpul, catatan:catatan},
                success: function (data) {
                    // alert(data);
                    load_folder();
                }
            });

        } else {
            $("#folder_name").css("border", "1px solid #FF5252");
            $("#error-folder_name").html("Nama belum diisi");
            $("#error-folder_name").show();
        }
    });
    $(document).on("click", ".konfirmasi-box", function () {
        var folder_name = $(this).data("name");
        $(".delete").show();
        $(".delete").val(folder_name);
        $(".remove_file").hide();
        $("#konfirmasi").show("slow");
    });
    $(document).on("click", ".update", function () {
        var action = "show update folder view";
        var folder_name = $(this).data("name");
        $.ajax({
            url: "get_folder_data.php",
            method: "POST",
            data: { action: action, folder_name: folder_name },
            success: function (data) {
                $(".kotak").html(data);
                // $(".judul-section").html("<h1>Materi Kuliah</h1><button id='up'><i class='fas fa-angle-left'></i> Kembali</button>");
                $("#up").show()
                $("#create_folder").hide();
            }
        });
    });
    $(document).on("click", ".delete", function () {
        var folder_name = $(this).val();
        var action = "delete";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action, folder_name: folder_name },
            success: function (data) {
                $("#konfirmasi").hide("slow");
                load_folder();
            }
        });
    });
    $(document).on("click", ".view_files", function () {
        var folder_name = $(this).data("name");
        var action = "fetch_files";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action, folder_name: folder_name },
            success: function (data) {
                $(".kotak").html(data);
                // $(".judul-section").html("<h1>Materi Kuliah</h1><button id='up'><i class='fas fa-angle-left'></i> Kembali</button>");
                $("#up").show()
                $("#create_folder").hide();
            }
        });
    });
    $(document).on("click", ".upload", function () {
        var folder_name = $(this).data("name");
        var action = "show upload form";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action, folder_name: folder_name },
            success: function (data) {
                $(".kotak").html(data);
                $(".judul-section").html("<h1>Kumpul Tugas</h1><button id='up'><i class='fas fa-angle-left'></i> Kembali</button>");
            }
        });
    });
    $(document).on("click", "#buat-folder", function(){
            var upload_file = $("#upload_file").val();
            if(!upload_file){
                if(!upload_file){
                    $("#upload_file").css("border", "1px solid #FF5252");
                    $("#error-upload_file").html("File belum diisi");
                    $("#error-upload_file").show();
                }else{
                    $("#upload_file").css("border", "none");
                    $("#error-upload_file").hide();
                }
                return false;
            }
    });
    $(document).on("submit", "#upload_form", function () {
        $.ajax({
            url: "upload_tugas.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                load_folder();
                // alert(data);
                // console.log("tes");
            }
        });
    });
    $(document).on("click", ".konfirmasi-box-remove", function () {
        var path = $(this).attr("id");
        $(".delete").hide();
        $(".remove_file").show();
        $(".remove_file").val(path);
        $("#konfirmasi").show("slow");
    });
    $(document).on("click", ".remove_file", function () {
        var path = $(this).val();
        var action = "remove_file";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: { action: action, path: path },
            success: function (data) {
                $("#konfirmasi").hide("slow");
                load_folder();
            }
        });
    });
    $(document).on("blur", ".change_file_name", function(){
        var folder_name = $(this).data("folder_name");
        var old_file_name = $(this).data("file_name");
        var new_file_name = $(this).text();
        var action = "change_file_name";
        $.ajax({
            url: "get_tugas_data.php",
            method: "POST",
            data: {folder_name: folder_name, old_file_name: old_file_name, new_file_name: new_file_name, action: action},
            success: function(data){
                // alert(data);
                load_folder();
            }
        });
    });
    $(document).on("click", ".trigger_change_file_name", function(){
        var nama = $(this).data("file_name");
        $("td[data-file_name='"+nama+"']").focus();
    });
});