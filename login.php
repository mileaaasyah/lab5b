<?php
include 'authenticate.php'; // Include authentication functions

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form and sanitize it
    $matric = trim($_POST['matric']);
    $inputPassword = trim($_POST['password']);

    // Call login function to authenticate the user
    if (login($matric, $inputPassword)) {
        echo "Login successful!";
        // Redirect or perform other actions after successful login
        header("Location: dashboard.php"); // Redirect to a dashboard or home page after login
        exit();
    } else {
        echo "Login failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="post">
        <label for="matric">Matric:</label>
        <input type="text" id="matric" name="matric" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
