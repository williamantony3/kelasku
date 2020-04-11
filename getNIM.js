// getNIM.js
$(document).ready(function(){
    $('#nim').keyup(function(){
        var txt = $(this).val();
        console.log(txt);
        if(txt.length === 0){
            console.log("kosongg");
        }else{
            $('#resultNIM').html('');
            $.ajax({
                url:"getNIM.php",
                method:"post",
                data:{search:txt},
                dataType:"text",
                success:function(data){
                    $('#resultNIM').html(data);
                }
            });
        }
    });
});