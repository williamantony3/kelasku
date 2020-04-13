// get_absen_data.js
$(document).ready(function(){
    // console.log("jquery masuk");
    setInterval(function(){
        $('#div_absen').load("get_absen_data.php").fadeIn("slow");
    }, 1000);
});