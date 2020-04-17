// calendar.js ini script buat bisa nampilin detail event, meski di console


    function reply_click(value){
        if(value.length!=1){
            let originalData = value.replace(/\$/g,' ');
            var data = originalData.split("#");
            console.log("Event title: " + data[0]);
            console.log("Event StartDate: " + data[1]);
            console.log("Event EndDate: " + data[2]);
            console.log("Event Place: " + data[3]);
            console.log("Event Note: " + data[4]);
        } else{
            console.log('No event bro, kasian kali kau');
        }
       
    }
