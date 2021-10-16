<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
    $novi = json_decode($postdata);
    $email = $novi->email;
    $ime =   $novi->ime;
    $prezime = $novi->prezime;
    $adresa = $novi->adresa;
    $telefon = $novi->telefon;
    
    if(!preg_match("/^([a-zA-Z ćčČĆ]{3,30}+)$/",$ime) || !preg_match("/^([a-zA-Z ćčČĆ]{3,30}+)$/",$prezime)||
    !preg_match("/^([a-zA-Z ćčČĆ0-9,]{20,150}+)$/",$adresa) || !preg_match("/^([0-9+ ]{6,15}+)$/",$telefon)) {
        http_response_code(400);
        echo "Uneti podaci nisu validni,Proverite adresu.";
    }
    else {
  
        $upit = "UPDATE `musterija` SET `ime` = '$ime', `prezime`='$prezime', `adresa`='$adresa', `telefon`='$telefon'
        WHERE `email` = '{$email}' LIMIT 1";
        $rez = mysqli_query($conn, $upit);
        if($rez) {
            http_response_code(200);
             echo json_encode("Korisnik promenjen.");
        }
        else {
            echo json_encode("Izmena nije uspela.");
            http_response_code(400);
        }
    }

}
else {
    http_response_code(422);
}


?>