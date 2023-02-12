<?php

require "../dataBroker.php";
require "../model2/zvanja.php";

if(isset($_POST['nameZ'])){
    $zv = new Zvanje(null,$_POST['nameZ']);
    $uspelo = Zvanje::add($zv, $conn);

    if($uspelo){
        echo 'Success si';
    }else{
        echo $uspelo;
        echo "Failed si";
    }
}


?>