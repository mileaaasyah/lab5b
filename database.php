<?php
$servername = "localhost"; // Change if necessary
$username = "mileasyah"; // Change if necessary
$password = "milliemia2003"; // Change if necessary
$dbname = "Lab_5b"; // Ensure this database exists

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
