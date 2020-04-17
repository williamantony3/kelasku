// loadAllNIM.js ini buat nampilin checkbox isi seluruh nim
$(document).ready(function(){
    console.log("Udah masuk");
    $('#resultNIM').html('');
    console.log($("#resultNIM"));
        $.ajax({
            url:"getAllNIM.php",
            method:"Get",
            success:function(data){
                $('#resultNIM').html(data);
            }
        });
});

function selectAll(source){
    let checkboxes = $('.checkboxNIM');
    console.log(checkboxes.length);
    for(let i=0; i<checkboxes.length; i++){
        checkboxes[i].checked =  source.checked;
    }
}

