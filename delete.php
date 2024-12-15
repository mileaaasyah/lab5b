<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
   header('Location: login.php');
   exit;
}

$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "Lab_5b";

$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_GET['matric'])) {
   $matricToDelete = $_GET['matric'];

   // Delete user from database
   $sqlDelete = "DELETE FROM users WHERE matric='$matricToDelete'";
   if ($conn->query($sqlDelete) === TRUE) {
       echo "Record deleted successfully. <a href='display.php'>View Users</a>";
   } else {
       echo "Error deleting record: " . $conn->error;
   }
} else {
   echo "No user specified.";
}

$conn->close();
?>
