<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

  $kod = $request->kod_kupona;
  $datum = $request->stanje;
  $validan = $request->validan;
  $popust = $request->popust;

  if(!preg_match("/^([0-9]{1,20}+)$/",$datum) || !preg_match("/^([0-9]{3,10}+)$/",$kod)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {

  $upit = "INSERT into kuponi (kod_kupona, stanje, validan, popust) VALUES ('$kod', '$datum', '$validan', '$popust')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $kupon = [
      'kod_kupona' => $kod,
      'stanje' => $datum,
      'validan' => $validan,
      'popust' => $popust
    ];
    echo json_encode($kupon);
  }
  else {
      http_response_code(404);
      echo "Unos novog kupona nije uspeo.";
  }

  }
}
else {
    http_response_code(404);
}
 ?>