<?php

require '../dbconnect.php';

$email = $_GET['email'];

if(!$email) {
    return http_response_code(400);
}

else {

    $upit = "SELECT  * FROM zahtevi WHERE email = '$email'";

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