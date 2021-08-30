<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
 
  $vrsta = $request->vrsta;
  $cena = $request->cena;


  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$vrsta)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO vrste_usluge (vrsta,cena) VALUES
  ('$vrsta','$cena')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'idUsluge' => mysqli_insert_id($conn),
      'vrsta' => $vrsta,
      'cena' => $cena
    ];
    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Dodavanje nove usluge nije uspelo.";
  }

  }
}
else {
    http_response_code(404);
}

?>