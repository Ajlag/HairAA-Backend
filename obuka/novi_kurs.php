<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $naziv=$request->naziv;
  $mentor = $request->mentor;
  $datum = $request->datum;
  $vreme = $request->vreme;
  $opis = $request->opis;
  
  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$mentor)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO kurs (naziv,mentor,datum,vreme,opis) VALUES ('$naziv','$mentor','$datum','$vreme', '$opis')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'IdKursa' => mysqli_insert_id($conn),
      'naziv'=>$naziv,
      'mentor' => $mentor,
      'datum' => $datum,
      'vreme' => $vreme,
      'opis'=> $opis
    ];
    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Unos nove obuke nije uspeo.";
  }

  }
}
else {
    http_response_code(404);
}

?>