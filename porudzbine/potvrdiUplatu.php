<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $IdPorudzbine = $request->IdPorudzbine;
  $uplaceno = $request->uplaceno;
  
  if(!preg_match("/^([a-zA-Z0-9. ćčČĆŽžŠš]{1,25}+)$/",$uplaceno)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "UPDATE porudzbina SET `uplaceno`='da' WHERE `IdPorudzbine` = '{$IdPorudzbine}'";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(200);
  }
  else {
      http_response_code(404);
      echo "Izmena zahteva nije uspela.";
   }
  }
}
else {
    http_response_code(404);
}

?>