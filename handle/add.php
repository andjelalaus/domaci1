<?php

require "../dataBroker.php";
require "../model2/profesor.php";

if(isset($_POST['name']) && isset($_POST['lastName']) 
&& isset($_POST['last-day-of-employment']) && isset($_POST['first-day-of-employment'])&& isset($_POST['role']) ){
    $profa = new Professor(null,$_POST['name'],$_POST['lastName'],$_POST['first-day-of-employment'],$_POST['last-day-of-employment'],$_POST['role'] );
    $uspelo = Professor::add($profa, $conn);

    if($uspelo){
        echo 'Success si';
    }else{
        echo $uspelo;
        echo "Failed si";
    }
}


?>