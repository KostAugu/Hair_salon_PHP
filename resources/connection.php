<?php

function connection() {
    $servername = "localhost";
    $username = "auto";
    $password = "LabaiSlaptas123";
    $dbname = "hair_salon";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}