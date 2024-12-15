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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET name='$name', role='$role' WHERE matric='$matric'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully. <a href='display.php'>View Users</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Get existing data for the user to update
    $matric = $_GET['matric'];
    
    $sql = "SELECT * FROM users WHERE matric='$matric'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User</title>
</head>
<body>
<h2>Update User</h2>
<form action="" method="post">
    <input type="hidden" name="matric" value="<?php echo htmlspecialchars($row['matric']); ?>">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required><br>

    <label for="role">Role:</label>
    <select id="role" name="role">
        <option value="<?php echo htmlspecialchars($row['role']); ?>" selected><?php echo htmlspecialchars($row['role']); ?></option>
        <option value="lecturer">Lecturer</option>
        <option value="student">Student</option>
        <option value="guest">Guest</option>
    </select><br>

    <input type="submit" value="Update">
</form>

<a href='display.php'>Cancel</a>

<?php
} else {
   echo "No user found.";
}
}
$conn->close();
?>
