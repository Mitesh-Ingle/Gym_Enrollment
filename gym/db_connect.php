<?php 

$host = 'localhost'; // Change if using a remote database
$username = 'root'; // Change if using a different MySQL user
$password = 'root'; // Change if you have a MySQL password
$database = 'gym_db';
$port = 3306;

// Create connection
$conn = new mysqli($host, $username, $password, $database, 3306);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
