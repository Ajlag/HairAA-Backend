<?php
// header('Access-Control-Allow-Origin:*');
// header('Access-Control-Allow-Credentials:true');
// header('Access-Control-Allow-Methods:GET,PUT,POST,DELETE,OPTIONS');
// header('Access-Control-Max-Age:1000');
// header('Access-Control-Allow-Headers:Origin,Content-Type,X-Auth-Token,Authorization');

if($_SERVER['REQUEST_METHOD']=='GET') {
 
 require_once '../dbconnect.php';
    
    $upit = "SELECT * FROM proizvodi";
    $rezultat = mysqli_query($conn,$upit);
    if($rezultat) {
        while($r = mysqli_fetch_assoc($rezultat)) {
            $proizvodi['lista'][] = $r;
          }
        echo json_encode($proizvodi['lista']);
        mysqli_close($conn);
    }
    else {
        http_response_code(404);
    }

}


?>