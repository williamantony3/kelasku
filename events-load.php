<?php

//load.php

$connect = new PDO('mysql:host=localhost;dbname=kelasku', 'root', '');

$data = array();

$query = "SELECT * FROM event";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["ID"],
  'title'   => $row["Name"],
  'start'   => $row["Date"] . " " . $row['Time'],
  'end'   => $row["Date"] . " " . $row['Time']
 );
}

echo json_encode($data);

?>
