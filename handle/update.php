<?php

require "../dataBroker.php";
require "../model2/profesor.php";

if(isset($_POST['name']) && isset($_POST['lastName']) 
&& isset($_POST['lastDay']) && isset($_POST['firstDay'])&& isset($_POST['role']) && isset($_POST['id'])){
   
    $prof = new Professor($_POST['id'],$_POST['name'],$_POST['lastName'],$_POST['firstDay'],$_POST['lastDay'],$_POST['role'] );
    $uspelo = Professor::update($prof, $conn);
    if ($uspelo){
        echo "Success si";
    }else{
        echo "Failed si";
    }
}else{
    echo "Nije setovano";
}

?>