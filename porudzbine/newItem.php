<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $porudzbina = $request->IdPorudzbine;
    $proizvod = $request->IdProizvoda;
    $kolicina = $request->dostupnost;
    $cena = $request->cena;

    $upit = "INSERT INTO sadrzi (IdPorudzbine, IdProizvoda, dostupnost, cena) VALUES ('$porudzbina', '$proizvod', '$kolicina', '$cena')";
    
    $rez = mysqli_query($conn,$upit);

    if($rez) {
        http_response_code(201);
        echo json_encode("Ok!");
    }
    else {
              http_response_code(400);
    }

}

else {
    http_response_code(404);
}



?>