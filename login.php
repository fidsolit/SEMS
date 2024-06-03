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
    $sql = "SELECT userid, username, password, position FROM user WHERE username = :username";

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
                $_SESSION['user_id'] = $user['userid'];  // Store user id in session
                $_SESSION['username'] = $user['username'];  // Store username in session

                // Redirect based on account type
                if ($user['position'] == 'user') {
                    // Set success message
                    $successMessage = "Login successful. Redirecting to dashboard...";
                    // Set a delay before redirecting
                    echo '<script>
                        setTimeout(function(){
                            window.location.href = "dashboard.php";
                        }, 1500);
                      </script>';
                    // Redirect user to user dashboard
                    header("Location: dashboard.php");
                    exit();
                } elseif ($user['position'] == 'admin') {
                    // Set success message
                    $successMessage = "Login successful. Redirecting to dashboard...";
                    // Set a delay before redirecting
                    echo '<script>
                        setTimeout(function(){
                            window.location.href = "dashboard.php";
                        }, 1500);
                      </script>';
                    // Redirect admin to admin dashboard
                    header("Location: admin-dashboard.php");
                    exit();
                }
            } else {
                // Invalid password
                $errorMessage = "Invalid password.";
            }
        } else {
            // User not found
            $errorMessage = "No user found with that username.";
        }
    } catch (PDOException $e) {
        $errorMessage = "Error: " . $e->getMessage();
    }
} else {
    // Not a POST request
    $errorMessage = "Invalid request.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            background: url(img/hehe.png);
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
        }

        .centered-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-container {
            background: linear-gradient(to right, #ccc, #eee);
            /* Greyish gradient background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #333;
            /* Dark text color for readability on a light background */
            width: 100%;
            /* Full width */
            max-width: 600px;
            /* Maximum width */
            border: 2px solid #333;
            /* Border with dark color */
        }

        .form-label {
            text-align: right;
        }

        .form-control-sm {
            max-width: 250px;
        }
    </style>
</head>

<body>
    <div class="centered-container">
        <div class="form-container">
            <h2 class="mb-3 text-center">Login Form</h2>
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success"><?php echo $_SESSION['success_message'];
                unset($_SESSION['success_message']); ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger"><?php echo $_SESSION['error_message'];
                unset($_SESSION['error_message']); ?></div>
            <?php endif; ?>
            <form action="login.php" method="post">

                <div class="mb-2 row">
                    <label for="username" class="col-md-3 col-form-label text-end">Username:</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control form-control-sm" id="username" name="username"
                            placeholder="Enter username" required>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="password" class="col-md-3 col-form-label text-end">Password:</label>
                    <div class="col-md-8">
                        <input type="password" class="form-control form-control-sm" id="password" name="password"
                            placeholder="Enter password" required>
                    </div>
                </div>

                <div class="mb-2 d-flex justify-content-center">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <p class="mt-2">Don't have an account? <a href="register.php" style="color: #333;">Register
                            here</a>.</p>
                </div>
            </form>
        </div>
    </div>
    <!-- Include Bootstrap JS and its dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>