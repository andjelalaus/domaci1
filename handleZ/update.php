<?php

require "../dataBroker.php";
require "../model2/zvanja.php";

if(isset($_POST['nameZC']) && isset($_POST['idZ'])){
   
    $zv = new Zvanje($_POST['idZ'],$_POST['nameZC']);
    $uspelo = Zvanje::update($zv, $conn);
    if ($uspelo){
        echo "Success si";
    }else{
        echo "Failed si";
    }
}else{
    echo "Nije setovano";
}

?>