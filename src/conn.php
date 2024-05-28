<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kompas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Błąd łączenia: " . $conn->connect_error);
}
?>