<?php


if($_SERVER['REQUEST_METHOD']=='GET') {
 
 require_once '../dbconnect.php';
 
    $upit = "SELECT * FROM admin";
    $rezultat = mysqli_query($conn,$upit);
    if($rezultat) {
        while($r = mysqli_fetch_assoc($rezultat)) {
            $admin['lista'][] = $r;
          }
        echo json_encode($admin['lista']);
        mysqli_close($conn);
    }
    else {
        http_response_code(404);
    }
}
else {
    http_response_code(400);
}

?>