<?php

require '../dbconnect.php';

$email = $_GET['email'];

if(!$email) {
    return http_response_code(400);
}

else {

    $upit = "SELECT porudzbina.datumP, sadrzi.IdPorudzbine, proizvodi.naziv, sadrzi.dostupnost, sadrzi.cena as totalProduct, 
    proizvodi.cena, porudzbina.ukupnaCena.
    FROM porudzbina, sadrzi, proizvodi WHERE porudzbina.IdPorudzbine = sadrzi.IdPorudzbine AND porudzbina.email = '$email'
    AND proizvodi.IdProizvoda = sadrzi.IdProizvoda";

    $rez = mysqli_query($conn, $upit);

    if($rez) {
        while($r = mysqli_fetch_assoc($rez)) {
            $kupovine['lista'][] = $r;
          }
        echo json_encode($kupovine['lista']);
        mysqli_close($conn);

    }
    else {
        http_response_code(404);
    }

}



?>