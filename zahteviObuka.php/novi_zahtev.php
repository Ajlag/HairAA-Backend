<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $idKursa=$request->idKursa;
  $email = $request->email;
  $status = $request->status;
  
  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$status)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO Zahtev_za_kurs (idKursa,email,status) VALUES ('$idKursa','$email', '$status')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'idZahteva' => mysqli_insert_id($conn),
      'idKursa'=>$idKursa,
      'email' => $email,
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