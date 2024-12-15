<?php
include 'authenticate.php';

if (!isLoggedIn()) {
    header('Location: login.php');
    exit;
}

include 'database.php';

// Start HTML document
echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>User List</title>
    <link rel='stylesheet' type='text/css' href='styles.css'> <!-- Link to CSS -->
</head>
<body>
    <h2>User List</h2>";

$sql = "SELECT matric, name, role FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Action</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row["matric"]) . "</td><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["role"]) . "</td>";
        echo "<td><a href='update.php?matric=".$row["matric"]."'>Update</a> | ";
        echo "<a href='delete.php?matric=".$row["matric"]."' onclick='return confirm(\"Are you sure?\");'>Delete</a></td></tr>";
    }
    
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close(); // Close connection

// End HTML document
echo "</body>
</html>";
?>
