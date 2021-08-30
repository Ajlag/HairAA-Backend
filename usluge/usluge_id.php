<?php

require '../dbconnect.php';

$id = ($_GET['idUsluge']!== null && (int)$_GET['idUsluge'] > 0)? mysqli_real_escape_string($conn, (int)$_GET['idUsluge']) : false;

if(!$id)
{
  return http_response_code(400);
}

$upit = "SELECT * from vrste_usluge WHERE `idUsluge` = '{$id}'";
$rez = mysqli_query($conn,$upit);

if($rez) {
    $produkt = mysqli_fetch_assoc($rez);
    echo json_encode($produkt);
}
else {
    http_response_code(404);
}


?>