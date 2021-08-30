<?php

require '../dbconnect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  $ime = $request->naziv;
  $lokacija = $request->lokacija;

  if(!preg_match("/^([a-zA-Z0-9, ćčČĆ]{3,30}+)$/",$ime) ||!preg_match("/^([a-zA-Z0-9, ćčČĆ]{10,50}+)$/",$lokacija) ) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  
  else {

  // Sanitize.
  $idD = mysqli_real_escape_string($conn, (int)$request->IdDobavljaca);
  $ime = mysqli_real_escape_string($conn, $request->naziv);
  $lokacija = mysqli_real_escape_string($conn, trim($request->lokacija));

  $sql = "UPDATE `dobavljac` SET `naziv`='$ime', `lokacija`='$lokacija' WHERE `IdDobavljaca` = '{$idD}' 
  LIMIT 1";

  if(mysqli_query($conn, $sql))
  {
    http_response_code(200);
  }
 }
}
  else
{
    return http_response_code(422);
} 


?>