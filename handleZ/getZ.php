<?php

require "../dataBroker.php";
require "../model2/zvanja.php";

if(isset($_POST['id'])){
    $niz = Zvanje::getById($_POST['id'], $conn);
    echo json_encode($niz);
}

?>