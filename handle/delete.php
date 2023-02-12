<?php

require "../dataBroker.php";
require "../model2/profesor.php";

if(isset($_POST['id'])){
    $prof = new Professor($_POST['id']);
    $uspelo = $prof->deleteById($conn);
    if ($uspelo){
        echo "Success si";
    }else{
        echo "Failed si";
    }
}

?>