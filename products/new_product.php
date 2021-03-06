<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $naziv = $request->naziv;
  $cena = $request->cena;
  $dostupno = $request->dostupnost;
  $dobavljac = $request->IdDobavljaca;

  if(!preg_match("/^([a-zA-Z0-9 .,ćčČĆŽžŠš]{3,25}+)$/",$naziv)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT INTO proizvodi (naziv,dostupnost,cena,idDobavljaca) VALUES
  ('$naziv','$dostupno','$cena', '$dobavljac')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $proizvod = [
      'IdProizvoda' => mysqli_insert_id($conn),
      'naziv' => $naziv,
      'dostupnost' => $dostupno,
      'cena' => $cena,
      'idDobavljaca' => $dobavljac
    ];
    echo json_encode($proizvod);
  }
  else {
      http_response_code(404);
      echo "Unos novog proizvoda nije uspeo.";
  }

  }
}
else {
    http_response_code(404);
}

?>