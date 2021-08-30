<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $idF = $request->idFrizera;
  $email= $request->email;
  $ime = $request->ime;
  $prezime = $request->prezime;
  $telefon = $request->telefon;
  $plata = $request->plata;
  $staz = $request->staz;
  
  if(!preg_match("/^([a-zA-Z0-9. ćčČĆŽžŠš]{3,25}+)$/",$ime)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "UPDATE frizer SET `email`='$email', `ime`='$ime', `prezime`='$prezime',`telefon`='$telefon',`plata`='$plata',`staz`='$staz'  WHERE `idFrizera` = '{$idF}'";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(200);
  }
  else {
      http_response_code(404);
      echo "Izmena frizera nije uspela.";
   }
  }
}
else {
    http_response_code(404);
}

?>