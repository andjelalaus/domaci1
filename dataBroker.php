<?php
$host = "localhost";
$db = "acredoc";
$user = "root";
$pass = "";

$conn = new mysqli($host,$user,$pass,$db);


if ($conn->connect_errno){
    exit("Niste uspeli da se konektujete: gresk je tipa> ".$conn->connect_error.", err kod>".$conn->connect_errno);
}

?>