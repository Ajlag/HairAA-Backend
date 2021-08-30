<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $idU = $request->idUsluge;
  $vrsta = $request->vrsta;
  $cena = $request->cena;
  
  if(!preg_match("/^([a-zA-Z0-9. ćčČĆŽžŠš]{3,25}+)$/",$vrsta)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "UPDATE vrste_usluge SET `vrsta`='$vrsta',`cena`='$cena' WHERE `idUsluge` = '{$idU}'";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(200);
  }
  else {
      http_response_code(404);
      echo "Izmena usluge nije uspela.";
   }
  }
}
else {
    http_response_code(404);
}

?>