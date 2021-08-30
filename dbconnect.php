<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, Accept, Client-Security-Token, Authorization, Accept-Encoding, Access-Control-Request-Method, X-API-KEY");
header("Access-Control-Max-Age: 86400");
header("Content-Type: application/json, charset=utf-8");



$conn = mysqli_connect('localhost', 'id17148713_hairsalonaa','Aminaajla1999/8','id17148713_frizerski_salon');


?>