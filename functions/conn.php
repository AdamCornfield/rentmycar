<?php 
// Defines the variables used to make a database connection, is referenced by many other files
$servername = "localhost";
$username = "root";
$password = "";
$database = 'rentmycar';
$port = NULL;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>