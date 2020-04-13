$(document).ready(function () {
    load_folder();
    function load_folder() {
        var action = "fetch";
        $.ajax({
            url: "get_folder_data.php",
            method: "POST",
            data: { action: action },
            success: function (data) {
                $(".kotak").html(data);
            }
        });
    }
    $(document).on("click", "#create_folder", function () {
        var action = "show create folder view";
        $.ajax({
            url: "get_folder_data.php",
            method: "POST",
            data: { action: action },
            success: function (data) {
                $(".kotak").html(data);
            }
        });
    });
    $(document).on("click", "#folder_button", function () {
        var folder_name = $("#folder_name").val();
        var action = $("#action").val();
        var old_name = $("#old_name").val();
        if (folder_name != "") {
            $.ajax({
                url: "get_folder_data.php",
                method: "POST",
                data: { folder_name: folder_name, old_name: old_name, action: action },
                success: function (data) {
                    alert(data);
                    load_folder();
                }
            });

        } else {
            alert("Enter folder name");
        }
    });
    $(document).on("click", ".konfirmasi-box", function () {
        var folder_name = $(this).data("name");
        $(".delete").val(folder_name);
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
            }
        });
    });
    $(document).on("click", ".delete", function () {
        var folder_name = $(this).val();
        var action = "delete";
        $.ajax({
            url: "get_folder_data.php",
            method: "POST",
            data: { action: action, folder_name: folder_name },
            success: function (data) {
                $("#konfirmasi").hide("slow");
                load_folder();
            }
        });
    });
    $(document).on("click", ".view_files", function(){
        var folder_name = $(this).data("name");
        var action = "fetch_files";
        $.ajax({
                url: "get_folder_data.php",
                method: "POST",
                data: {action: action, folder_name: folder_name},
                success: function(data){
                    $(".kotak").html(data);
                }
        });
    });
});