<?php 

    require_once '../dbconnect.php';

    $musterija = file_get_contents("php://input");
    $novi = json_decode($musterija,true);
    
    $ime = $novi['ime'];
    $prezime = $novi['prezime'];
    $email = $novi['email'];
    $lozinka = $novi['lozinka'];
    $adresa = $novi['adresa'];
    $telefon = $novi['telefon'];
    
    $admin = $novi['admin'];
  
    
    if(isset($musterija) && !empty($musterija)) {
         if(!preg_match("/^([a-zA-Z ćčČĆ]{3,30}+)$/",$ime) || !preg_match("/^([a-zA-Z ćčČĆ]{3,30}+)$/",$prezime) ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($lozinka) < '6'  || !preg_match("#[0-9]+#",$lozinka) || !preg_match("/^([0-9+ ]{6,15}+)$/",$telefon) ||
    !preg_match("#[A-Z]+#",$lozinka) || !preg_match("#[a-z]+#",$lozinka)){
        http_response_code(400);
        echo "Uneti podaci nisu validni.";
    } else {

    $lozinkaHash = password_hash($lozinka, PASSWORD_DEFAULT);

    $upit = "INSERT INTO musterija (idMusterije,ime,prezime,email,lozinka,adresa,telefon,admin) VALUES 
    (NULL,'$ime', '$prezime','$email','$lozinkaHash','$adresa', '$telefon','$admin')";

    if(mysqli_query($conn, $upit)) {
        http_response_code(201);

      //  $to = $email;
      //  $message = "Hvala Vam na poverenju ," .$email. ". Uživajte u korišćenju sajta. Tim Amina i Ajla";
      //  $message = wordwrap($message,70);
      //  $subject = "Hair Salon registracija";
      //  $headers = 'From: dolicaninamina1999@gmail.com' . "\r\n" .
      //  'Reply-To: dolicaninamina1999@gmail.com' . "\r\n" .
      //  'X-Mailer: PHP/' . phpversion();
      //  $mejl = mail($to, $subject, $message, $headers);
        
        $user = [
        'idMusterije' => mysqli_insert_id($conn),
        'ime' => $ime,
        'prezime' => $prezime,
        'email' => $email,
        'lozinka' => $lozinkaHash,
        'adresa' => $adresa,
        'telefon' => $telefon,
        'admin' => $admin
          ];
        echo json_encode($user);
    }
    else {
        http_response_code(404);
        echo "Email adresa koju ste uneli je zauzeta.";
   }
  }
}
else {
    http_response_code(422);
}

?>