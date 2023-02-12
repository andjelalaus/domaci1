<?php

require "../dataBroker.php";
require "../model2/profesor.php";

if(isset($_POST['id'])){
    $niz = Professor::getById($_POST['id'], $conn);
    echo json_encode($niz);
}

?>