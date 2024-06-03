<?php
// Database connection settings
$host = "localhost"; // Change this if your database server is on a different host
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "sems_db"; // Change this to your database name

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

// Process form data if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $birthday = $conn->real_escape_string($_POST['birthday']);
    $age = $conn->real_escape_string($_POST['age']);
    $email = $conn->real_escape_string($_POST['email']);
    $position = $conn->real_escape_string($_POST['position']);
    $IDnumber = $conn->real_escape_string($_POST['IDnumber']);
    $Yearlevel = $conn->real_escape_string($_POST['Yearlevel']);
    
    // Insert data into users table
    $sql = "INSERT INTO user (username, password, name, address, gender, birthday, age, email, position, IDnumber, Yearlevel) 
            VALUES ('$username', '$password', '$name', '$address', '$gender', '$birthday', '$age', '$email', '$position', '$IDnumber', '$Yearlevel')";

    
    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        header("Location: index.php");
        exit();
    } else {
        // If there's an error, redirect back to the registration form with an error message
        header("Location: register.php?error=" . urlencode("Error: " . $conn->error));
        exit();
    }
}

// Close database connection
$conn->close();
?>
