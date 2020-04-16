<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pgh";

$conn = new mysql($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 $conn->set_charset('utf8mb4'); 



    $feedcontent = array();
$query = "SELECT * FROM `t_patient_observation`";
    if ($result = $conn->query($query)) 
while($row = $result->fetch_array(MYSQLI_ASSOC))
$feedcontent [] = $row;
$output = json_encode(array('observations' => $feedcontent));
$conn->close();
echo $output;



?>