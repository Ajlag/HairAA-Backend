<?php


if($_SERVER['REQUEST_METHOD']=='GET') {

    require_once '../dbconnect.php';
    $upit = "SELECT * FROM dobavljac";
    $rez = mysqli_query($conn,$upit);
    $dobavljaci = [];
    if($rez) {
        while($r = mysqli_fetch_assoc($rez)) {
            $dobavljaci['lista'][] = $r;
          }
        echo json_encode($dobavljaci['lista']);
        mysqli_close($conn);
    }
    else {
        http_response_code(404);
    }

}

?>