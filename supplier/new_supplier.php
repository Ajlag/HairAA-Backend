<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $ime = $request->naziv;
  $lokacija = $request->lokacija;

  if(!preg_match("/^([a-zA-Z0-9, ćčČĆ]{3,30}+)$/",$ime) ||!preg_match("/^([a-zA-Z0-9, ćčČĆ]{10,50}+)$/",$lokacija) ) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT into dobavljac (IdDobavljaca, naziv, lokacija) VALUES (NULL, '$ime', '$lokacija')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $dobavljac = [
      'IdDobavljaca' => mysqli_insert_id($conn),
      'naziv' => $ime,
      'lokacija' => $lokacija,
    ];
    echo json_encode($dobavljac);
  }
  else {
      http_response_code(404);
      echo "Unos novog dobavljaca nije uspeo.";
  }

  }

}
else {
    http_response_code(404);
}

?>