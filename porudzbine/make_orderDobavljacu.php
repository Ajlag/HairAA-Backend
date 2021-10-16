<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);
  $datumP = $request->datumP;
  $ukupnaCena = $request->ukupnaCena;
  $email = $request->email;
  $uplaceno = $request->uplaceno;

  $upit = "INSERT INTO porudzbinaDobavljacu (IdPorudzbine,datumP,ukupnaCena,email,uplaceno) VALUES (NULL,'$datumP','$ukupnaCena','$email','$uplaceno')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'IdPorudzbine' => mysqli_insert_id($conn),
      'datumP' => $datumP,
      'ukupnaCena' => $ukupnaCena,
      'email' => $email,
      'uplaceno'=> $uplaceno
    ];
    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Kupovina nije uspela.";
  }

  
}
else {
    http_response_code(404);
}

?>