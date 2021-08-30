<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $idP = $request->IdProizvoda;
  $naziv = $request->naziv;
  $dostupno = $request->dostupnost;
  $cena = $request->cena;
  $dobavljac = $request->IdDobavljaca;
  
  if(!preg_match("/^([a-zA-Z0-9. ćčČĆŽžŠš]{3,25}+)$/",$naziv)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "UPDATE proizvodi SET `naziv`='$naziv', `dostupnost`='$dostupno', `cena`='$cena',`IdDobavljaca`='$dobavljac' WHERE `IdProizvoda` = '{$idP}'";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(200);
  }
  else {
      http_response_code(404);
      echo "Izmena proizvoda nije uspela.";
   }
  }
}
else {
    http_response_code(404);
}

?>