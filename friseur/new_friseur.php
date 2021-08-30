<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $email = $request->email;
  $ime = $request->ime;
  $prezime = $request->prezime;
  $telefon = $request->telefon;
  $plata=$request->plata;
  $staz=$request->staz;

  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$ime)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO frizer (email,ime,prezime,telefon,plata,staz) VALUES
  ('$email','$ime','$prezime', '$telefon','$plata','$staz')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'idFrizera' => mysqli_insert_id($conn),
      'email' => $email,
      'ime' => $ime,
      'prezime' => $prezime,
      'telefon' => $telefon,
      'plata'=>$plata,
      'staz'=>$staz
    ];

    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Dodavanje novog frizera nije uspelo.";
  }

  }
}
else {
    http_response_code(404);
}

?>