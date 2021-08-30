<?php

require '../dbconnect.php';

$id = ($_GET['IdProizvoda']!== null && (int)$_GET['IdProizvoda'] > 0)? mysqli_real_escape_string($conn, (int)$_GET['IdProizvoda']) : false;

if(!$id)
{
  return http_response_code(400);
}

$upit = "SELECT * from proizvodi WHERE `IdProizvoda` = '{$id}'";
$rez = mysqli_query($conn,$upit);

if($rez) {
    $produkt = mysqli_fetch_assoc($rez);
    echo json_encode($produkt);
}
else {
    http_response_code(404);
}


?>