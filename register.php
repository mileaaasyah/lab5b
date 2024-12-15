<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'authenticate.php'; // Include authentication functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form and sanitize it
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);

    // Call createUser function to register the new user
    createUser($matric, $name, $password);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>Register User</h2>
    <form action="register.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
