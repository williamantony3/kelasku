$(document).ready(function () {
    load_event();
    // var calendarEl = document.getElementById('calendar');
    function load_event() {
        $.ajax({
            url: "events-detail.php",
            type: "POST",
            success: function (data) {
                $("#acara-detail").html(data);
                $("#create_folder").show();
                $("#up").hide()
            }
        })
    }
    var calendar = $('#calendar').fullCalendar({
        // var calendar = new FullCalendar.Calendar(calendarEl, {
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        locale: 'id',
        events: 'events-load.php',
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
            var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
            $.ajax({
                url: "events-detail.php",
                type: "POST",
                data: { start: start, end: end },
                success: function (data) {
                    $("#acara-detail").html(data);
                }
            })
        }
        // editable: true,
        // eventResize: function (event) {
        //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        //     var title = event.title;
        //     var id = event.id;
        //     $.ajax({
        //         url: "update.php",
        //         type: "POST",
        //         data: { title: title, start: start, end: end, id: id },
        //         success: function () {
        //             calendar.fullCalendar('refetchEvents');
        //             alert('Event Update');
        //         }
        //     })
        // },

        // eventDrop: function (event) {
        //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
        //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
        //     var title = event.title;
        //     var id = event.id;
        //     $.ajax({
        //         url: "update.php",
        //         type: "POST",
        //         data: { title: title, start: start, end: end, id: id },
        //         success: function () {
        //             calendar.fullCalendar('refetchEvents');
        //             alert("Event Updated");
        //         }
        //     });
        // },

        // eventClick: function (event) {
        //     if (confirm("Are you sure you want to remove it?")) {
        //         var id = event.id;
        //         $.ajax({
        //             url: "delete.php",
        //             type: "POST",
        //             data: { id: id },
        //             success: function () {
        //                 calendar.fullCalendar('refetchEvents');
        //                 alert("Event Removed");
        //             }
        //         })
        //     }
        // },

    });
    
    $(document).on("focus", "#tanggal_kumpul", function(){
        $(this).attr("type", "date");
    });
    $(document).on("focus", "#waktu_kumpul", function(){
        $(this).attr("type", "time");
    });

});
