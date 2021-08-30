<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
    $request = json_decode($postdata);
    $datum = $request->datumP;
    $ukupna = $request->ukupnaCena;
    $mejl = $request->email;

    $upit = "INSERT INTO porudzbina (IdPorudzbine, datumP, ukupnaCena, email) VALUES 
    (NULL, '$datum', '$ukupna', '$mejl')";

    $rez = mysqli_query($conn,$upit);
    if($rez) {
        http_response_code(201);
        $porudzbina = [
            'IdPorudzbine' => mysqli_insert_id($conn),
            'datumP' => $datum,
            'ukupnaCena' => $ukupna,
            'email' => $mejl,
        ];
        echo json_encode($porudzbina);

    }
    else {
        http_response_code(400);
    }

}

else {
    http_response_code(404);
}



?>