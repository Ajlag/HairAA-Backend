<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $email = $request->email;
  $vrsta = $request->vrsta;
  $datum = $request->datum;
  $vreme = $request->vreme;
  $status = $request->status;
  
  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$vrsta)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO zahtevi (email,vrsta,datum,vreme,status) VALUES ('$email','$vrsta','$datum','$vreme', '$status')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'idZahteva' => mysqli_insert_id($conn),
      'email' => $email,
      'vrsta' => $vrsta,
      'vreme' => $vreme,
      'datum' => $datum,
      'status'=> $status
    ];
    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Slanje novog zahteva nije uspelo.";
  }

  }
}
else {
    http_response_code(404);
}

?>