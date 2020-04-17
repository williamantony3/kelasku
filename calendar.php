<!-- index.php Ini bikin kalendernya-->
<?php
function build_calendar($month, $year, $NIM){
    $firstDayOfMonth = mktime(0,0,0,$month,1,$year); 
    $firstDateOfMonth = date("Y-m-d", $firstDayOfMonth); //ini biar bisa nyari di database

    $conn = mysqli_connect('localhost', 'root', '', 'kelasku');
    $result = mysqli_query($conn, "SELECT * FROM `event`E JOIN eventdetail D WHERE D.NIM = '$NIM' AND D.EventID=E.EventID AND MONTH('$firstDateOfMonth') AND YEAR('$firstDateOfMonth')");
    // $result = mysqli_query($conn,"SELECT * FROM `event` WHERE MONTH('$firstDateOfMonth') AND YEAR('$firstDateOfMonth')");
    $eventTitle = array();
    $eventStartDate = array(); 
    $eventEndDate = array();
    $eventPlace = array();
    $eventNote = array();
    // echo (mysqli_num_rows($result));//bulan ini ada n event
    if(mysqli_num_rows($result)>0){ //dapetin seluruh data event per bulan dari database
        while($row = mysqli_fetch_array($result)){
            array_push($eventTitle, $row['EventTitle']);
            array_push($eventStartDate, $row['StartDate']);
            array_push($eventEndDate, $row['EndDate']);
            array_push($eventPlace, $row['Place']);
            array_push($eventNote, $row['Note']);
        }
    }
    // echo sizeof($eventStartDate);
    // echo $eventStartDate[0];
    // echo gettype($eventTitle);
    $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');   
    $numberDays = date("t", $firstDayOfMonth);   
    $isTodayBusy=array(); //array flag buat kalender yg nda ada event, nanti tulisannya no event
    for($i=0; $i<$numberDays; $i++){
        array_push($isTodayBusy, false);
    }
    $dateComponents = getdate($firstDayOfMonth);
    // echo $dateComponents[0];

    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');
    // echo $dateToday;
    
    $calendar = "<table class='table table-bordered'>"; //ni mulai bikin kalender
    $calendar.= "<center> <h2> $monthName $year </h2> ";
    //3 di bawah ini button, nanti dia passing 3 parameter ke diri sendiri
    $calendar.="<a class='btn btn-xs btn-primary' href='index.php?month=".date('m', mktime(0,0,0, $month-1, 1, $year))."&year=".date('Y', mktime(0,0,0, $month-1, 1, $year))."&nim=".$NIM."'> Prev Month </a>";    
    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m')."&year=".date('Y')."&nim=".$NIM."'> Current Month </a>";    
    $calendar.="<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0,0,0, $month+1, 1, $year))."&year=".date('Y', mktime(0,0,0, $month+1, 1, $year))."&nim=".$NIM."'> Next Month </a></center><br>";

    $calendar.= "<tr>";

    foreach($daysOfWeek as $day){
        $calendar.= "<th class='header'>$day</th>";
    }
    $calendar.="<tr></tr>";
   
    //mastiin jumlah hari ada 7
    if($dayOfWeek>0){
        for($k=0;$k<$dayOfWeek; $k++){
            $calendar.="<td></td>";
        }
    }
    //inisialisasi day counter
    $currentDay = 1;
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
   
    while($currentDay<=$numberDays){ //ini bikin kotak" tiap harinya
        if($dayOfWeek==7){//biar bisa turun kalo udah sabtu
            $dayOfWeek=0;
            $calendar.= "</tr><tr>";
        }
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $date = "$year-$month-$currentDayRel";
        $cnt=array();//buat looping banyak event dlm 1 hari
        if($dateToday==$date){
            $calendar.="<td class='today'><h4>$currentDay</h4>";
        }  else{
            $calendar.="<td><h4>$currentDay</h4>";
        } 
        for($i=0; $i<sizeof($eventStartDate); $i++){
            if(date('Y-m-d', strtotime($eventStartDate[$i]))==$date && $date >= $dateToday){ //event yg available warnanya ijo
                $isTodayBusy[$currentDay]=true;
                $buttonData = str_replace(' ', '$', $eventTitle[$i]."#". $eventStartDate[$i]."#".$eventEndDate[$i]."#".$eventPlace[$i]."#".$eventNote[$i]);//supaya data nda hilang krn spasi, spasi diilangkan
                $calendar.="<button id=$currentDay  value=$buttonData class='btn btn-success btn-xs' onClick=\"reply_click(this.value)\" >$eventTitle[$i]</button>";
            } else if(date('Y-m-d', strtotime($eventStartDate[$i]))==$date && $date <= $dateToday){ //event terlewat warnanya merah
                $isTodayBusy[$currentDay]=true;
                $buttonData = str_replace(' ', '$', $eventTitle[$i]."#". $eventStartDate[$i]."#".$eventEndDate[$i]."#".$eventPlace[$i]."#".$eventNote[$i]);
                $calendar.="<button id=$currentDay  value=$buttonData class='btn btn-danger btn-xs' onClick=\"reply_click(this.value)\" >$eventTitle[$i]</button>"; 
            }
        }
        // ini yang seharian gabut nda ada event
        if($isTodayBusy[$currentDay]==false) $calendar.="<button id=$currentDay value='' class='btn btn-xs' onClick=\"reply_click(this.id)\">No Event</button>";
        $calendar.="</td>";

        //tambahi counter
        $currentDay++;
        $dayOfWeek++;
    }
    if($dayOfWeek !=7){
        $remainingDays = 7-$dayOfWeek;
        for($i=0; $i<$remainingDays; $i++){
            $calendar.="<td></td>";
        }
    }

    $calendar.="</tr>";
    $calendar.="</table>";

    echo $calendar;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="table.css">
    <script src="calendar.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $dateComponents=getdate();
                    // $month = $dateComponents['mon'];
                    // $year = $dateComponents['year'];
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                    $NIM = $_GET['nim'];
                    echo build_calendar($month, $year, $NIM);
                ?>
            </div>
        </div>
        <button id = "32" class="btn" href="./registerEvent.html">Tambah Event</button>
    </div>
</body>
</html>
<script>
    
</script>
