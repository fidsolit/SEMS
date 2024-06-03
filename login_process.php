<?php
session_start();

// Placeholder for a user database
$users = [
    'admin' => 'password123',
    'user' => 'userpass'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Check if the username exists and password is correct
    if (isset($users[$username]) && $users[$username] === $password) {
        // Set a session variable to indicate that the user is logged in
        $_SESSION['username'] = $username;

        // Redirect to the dashboard
        header('Location: dashboard.php');
        exit;
    } else {
        // Redirect back to the login page with an error message
        header('Location: login.php?error=Invalid credentials');
        exit;
    }
}
?>