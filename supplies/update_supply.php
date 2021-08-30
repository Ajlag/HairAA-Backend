<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $id = $request->Id;
  $dobavljac = $request->IdDobavljaca;
  $artikal = $request->naziv;
  $kolicina = $request->kolicina;
  $datum  = $request->datum;
  $cena  = $request->cena;

  if(!preg_match("/^([a-zA-Z0-9 ]{3,25}+)$/",$artikal)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "UPDATE dobavlja SET `IdDobavljaca`='$dobavljac', `naziv`='$artikal', `kolicina`='$kolicina', `datum`='$datum', `cena`='$cena'
  WHERE `Id` = '{$id}'";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(200);
  }
  else {
      http_response_code(404);
      echo "Unos novog dobavljanja nije uspeo.";
  }

  }
}
else {
    http_response_code(404);
}

?>