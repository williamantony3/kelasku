    <?php

    //load.php

    $connect = new PDO('mysql:host=localhost;dbname=kelasku', 'root', '');

    $data = array();
    if(isset($_POST['start'])){

        $waktu = explode(" ",$_POST['start']);
        $hari = $waktu[0];
    }else{
        $hari = date("Y-m-d");
    }

    $query = "SELECT * FROM event WHERE Date='$hari' ORDER BY Time ASC";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    $output = "<h2>Detail Acara</h2>";

    if(count($result) != 0){
        foreach($result as $row)
        {
        $output .= "
            <a href='detail_acara.php?id=".$row['ID']."'>
            <div class='acara-item'>
                <div class='acara-kiri'>
                    <i class='fas fa-calendar'></i>
                </div>
                <div class='acara-kanan'>
                    <div class='judul-acara'>".$row['Name']."</div>
                    <div class='detail-acara'>Jam ".$row['Time']. " di " . $row['Place'] . "</div>
                </div>
            </div>
            </a>
        ";
        }

    }else{
        $output .= "<div class='acara-item'><div class='judul-acara'>Tidak ada acara hari ini</div></div>";
    }

    echo $output;

    ?>
