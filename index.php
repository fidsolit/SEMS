<?php
session_start();  // Start the session

// Include database configuration
include 'config.php';



// Initialize variables for messages
$successMessage = $errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']); // Trim to remove any accidental whitespace
    $password = $_POST['password'];

    // Prepare SQL to fetch user data
    $sql = "SELECT id, username, password, position FROM user WHERE username = :username";

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the parameters
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        // Fetch the user
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify user exists and check password
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // User authenticated
                $_SESSION['id'] = $user['userid'];  // Store user id in session
                $_SESSION['username'] = $user['username'];  // Store username in session

                // Redirect based on account type
                if ($user['position'] == 'user') {
                    // Set success message
                    $_SESSION['success_message'] = "Login successful. Redirecting to user dashboard...";
                    header("Location: dashboard.php");
                    exit();
                } elseif ($user['position'] == 'admin') {
                    // Set success message
                    $_SESSION['success_message'] = "Login successful. Redirecting to admin dashboard...";
                    header("Location: admin-dashboard.php");
                    exit();
                }
            } else {
                // Invalid password
                $_SESSION['error_message'] = "Invalid password.";
            }
        } else {
            // User not found
            $_SESSION['error_message'] = "No user found with that username.";
        }
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <div class="mainContainer">
        <div class="mainTitle" data-aos="fade-down">
            <h1 class="">School Event and Management System</h1>
        </div>


        <div class="container-fluid bg-light px-md-3 w-100 h-100 pb-3">
            <div class="row  align-items-center justify-content-center p-3 m-3">
                <div class="col-md-8 bg-danger" data-aos="fade-right">
                    <img src="./img/mainpic.png" class=" w-100 " alt=" School Logo">

                </div>
                <div class=" col-md-4 login" data-aos="fade-left">
                    <h3 class="text-center">User Login</h3>
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success"><?php echo $_SESSION['success_message'];
                        unset($_SESSION['success_message']); ?></div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger"><?php echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']); ?></div>
                    <?php endif; ?>
                    <form action="index.php" method="POST">
                        <label for="username">User</label>
                        <input type="text" id="username" name="username" placeholder="Username" required>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <p><a href="#">Forgotten Password?</a></p>
                        <button type="submit">Sign In</button>
                    </form>
                    <p>Don't have an account yet? <a href="register.php">Sign Up here</a></p>
                </div>
            </div>




        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
        integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>