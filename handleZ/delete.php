<?php

require "../dataBroker.php";
require "../model2/zvanja.php";

if(isset($_POST['id'])){
    $zv = new Zvanje($_POST['id']);
    $uspelo = $zv->deleteById($conn);
    if ($uspelo){
        echo "Success si";
    }else{
        echo "Failed si";
    }
}

?>