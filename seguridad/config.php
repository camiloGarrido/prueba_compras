<?php

$servername = "127.0.0.1";  // Host
$username = "admin";  //User
$password = 'admin'; // Password  
$dbname = "ventas"; // dbname
$port = 3307; // dbname

$conn = new mysqli($servername, $username, $password, $dbname, $port);
if ($conn->connect_error) {
die("Conexion Fallida: " . $conn->connect_error);
}

?>