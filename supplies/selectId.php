<?php

require '../dbconnect.php';

$naziv = $_GET['naziv'];

if(!$naziv) {
    return http_response_code(400);
}

else {
   $upit = "SELECT IdDobavljaca FROM dobavljac WHERE naziv = '$naziv' LIMIT 1";
   $rez = mysqli_query($conn, $upit);
   if($rez) {
       $current = mysqli_fetch_assoc($rez);
       http_response_code(200);
       echo json_encode($current);
   }
   else {
       http_response_code(404);
   }
}
?>