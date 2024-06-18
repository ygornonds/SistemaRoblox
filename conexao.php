<?php
$servername = "localhost";
$user = "root";
$pass = "";
try{
    $conn = new PDO("mysql:host=$servername;dbname=crud_roblox", $user,$pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  
}catch(PDOException $erro){
    echo "nao deu certo" . $erro->getMessage();
}