<?php

if($_SERVER['REQUEST_METHOD']=='GET') {
 
 require_once '../dbconnect.php';
    
    $upit = "SELECT Zahtev_za_kurs.idZahteva,Zahtev_za_kurs.idKursa,kurs.naziv,Zahtev_za_kurs.email,Zahtev_za_kurs.status FROM Zahtev_za_kurs,kurs WHERE Zahtev_za_kurs.idKursa=kurs.IdKursa AND status='cekanje'";
    
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