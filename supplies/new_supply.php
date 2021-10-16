<?php

require '../dbconnect.php';

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  $request = json_decode($postdata);

//   $id = $request->Id;
  $dobavljacL= $request->IdDobavljaca;
  $naziv= $request->imeDobavljaca;
  $artikal = $request->naziv;
  $kolicina = $request->kolicina;
  $datum  = $request->datum;
  $cena = $request->cena;
  $dobavljac= null;

  if(!preg_match("/^([a-zA-Z0-9 ]{3,25}+)$/",$artikal)) {
    http_response_code(400);
    echo json_encode("Uneti podaci nisu validni.");
  }
  else {
       $upit2 = "SELECT IdDobavljaca FROM dobavljac WHERE naziv = '$naziv' LIMIT 1";
   $rez2 = mysqli_query($conn, $upit2);
   if($rez2) {
         while($r = mysqli_fetch_assoc($rez2)) {
            $dobavljacR = $r;
            
          }
        
          
        $dobavljac=$dobavljacR['IdDobavljaca'];
      
   }

  $upit = "INSERT into dobavlja (Id, IdDobavljaca, naziv, kolicina, datum,cena) VALUES 
  (NULL, '$dobavljac', '$artikal', '$kolicina', '$datum', '$cena')";
  $rez  = mysqli_query($conn, $upit);

  if($rez) {
    http_response_code(201);
    $dobavlja = [
      'Id' => mysqli_insert_id($conn),
      'IdDobavljaca' => $dobavljac,
      'naziv' => $artikal,
      'kolicina' => $kolicina,
      'datum' => $datum,
      'cena' => $cena
    ];
    echo json_encode($dobavlja);
  }
  else {
      http_response_code(404);
      echo "Unos novog dobavljanja nije uspeo.";
  }

  }
}
else {
    http_response_code(404);
}

?>