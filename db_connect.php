<?php

$servername = "localhost";   
$username   = "root";        
$password   = "";            
$dbname     = "form_db";     

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<p style='color:red;'>Database Connection Failed: " . $conn->connect_error . "</p>");
}
?>
