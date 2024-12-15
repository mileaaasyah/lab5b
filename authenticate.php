<?php
session_start();

// Function to check if the user is logged in
function isLoggedIn() {
    return isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
}

// Function to handle user login
function login($matric, $inputPassword) {
    include 'database.php'; // Include database connection

    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT password FROM users WHERE matric=?");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error); // Error preparing statement
    }

    // Bind parameters (s = string)
    $stmt->bind_param("s", $matric);

    // Execute the statement
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password using crypt()
            if (hash_equals($row['password'], crypt($inputPassword, $row['password']))) {
                session_regenerate_id(true); // Regenerate session ID upon successful login
                $_SESSION['loggedin'] = true; // Set session variable for logged in status
                $_SESSION['matric'] = $matric; // Store matric in session
                return true; // Successful login
            } else {
                echo "Invalid password."; // Password verification failed
            }
        } else {
            echo "No user found with that matric."; // No user found
        }
    } else {
        die("Login query failed: " . $stmt->error); // Error executing query
    }

    return false; // Authentication failed
}

// Function to handle user logout
function logout() {
    session_start(); // Start session if not already started
    session_destroy(); // Destroy the session, logging out the user
}

// Function to create a new user
function createUser($matric, $name, $password) {
    include 'database.php'; // Include database connection

    // Generate a salt and hash the password using crypt()
    $salt = substr(sha1(mt_rand()), 0, 22); // Generate a random salt
    $hashedPassword = crypt($password, '$2y$10$' . $salt); // Hash the password with the salt

    // Prepare statement to insert new user
    $stmt = $conn->prepare("INSERT INTO users (matric, name, password) VALUES (?, ?, ?)");
    
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("sss", $matric, $name, $hashedPassword);
    
    if ($stmt->execute()) {
        echo "User created successfully.";
    } else {
        echo "Error creating user: " . $stmt->error;
    }

    $stmt->close(); // Close statement
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
