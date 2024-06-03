<?php
// Include database configuration
include 'config.php';

// Initialize variables for messages
$successMessage = $errorMessage = '';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect input data
    $name = $_POST['name'];
    $number = $_POST['number'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $age = $_POST['age'];
    $position = $_POST['position'];
    $IDnumber = $_POST['IDnumber'];
    $Yearlevel = $_POST['Yearlevel'];

    // Start transaction
    $pdo->beginTransaction();

    try {
        // Prepare an SQL statement to insert user data
        $sql = "INSERT INTO user (name, number, username, email, password, address, gender, birthday, age, position, IDnumber, Yearlevel) VALUES (:name, :number, :username, :email, :password, :address, :gender, :birthday, :age, :position, :IDnumber, :Yearlevel)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':IDnumber', $IDnumber);
        $stmt->bindParam(':Yearlevel', $Yearlevel);

        // Execute the statement
        $stmt->execute();

        // Commit the transaction
        $pdo->commit();

        // Set success message
        $successMessage = "Account created successfully. Redirecting to login page...";
        // Redirect to login page after 1.5 seconds
        echo '<script>
                setTimeout(function(){
                    window.location.href = "index.php";
                }, 1500);
              </script>';
    } catch (Exception $e) {
        // Rollback the transaction if an error occurred
        $pdo->rollback();

        // Set error message
        $errorMessage = "An error occurred. Please try again." . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            /* Full height */
            margin: 0;
            /* Reset default margin */
            background: url(img/hehe.png);
            background-repeat: no-repeat;
            background-size: cover;
            color: #fff;
            /* White text color for better readability on a dark background */
        }

        .centered-container {
            min-height: 100vh;
            /* 100% of the viewport height */
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
            /* Align labels to the right */
        }
    </style>
</head>

<body>

    <div class="centered-container">
        <div class="form-container">
            <h2 class="mb-3 text-center">Registration Form</h2>
            <?php if ($successMessage): ?>
                <div class="alert alert-success"><?php echo $successMessage; ?></div>
            <?php endif; ?>
            <?php if ($errorMessage): ?>
                <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
            <?php endif; ?>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <div class="mb-3 row">
                    <label for="firstName" class="col-sm-4 col-form-label text-end">First Name</label>
                    <div class="col-sm-6">
                        <input type="text" id="name" name="name" placeholder="Enter Fullname"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="number" class="col-sm-4 col-form-label text-end">Phone Number</label>
                    <div class="col-sm-6">
                        <input type="tel" id="number" name="number" placeholder="Enter Phone number"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="username" class="col-sm-4 col-form-label text-end">Username</label>
                    <div class="col-sm-6">
                        <input type="username" id="email" name="username" placeholder="Enter Username"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label text-end">Email</label>
                    <div class="col-sm-6">
                        <input type="text" id="email" name="email" placeholder="Enter Email"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-4 col-form-label text-end">Password</label>
                    <div class="col-sm-6">
                        <input type="password" id="password" name="password" placeholder="Enter Password"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="address" class="col-sm-4 col-form-label text-end">Address</label>
                    <div class="col-sm-6">
                        <input type="address" id="address" name="address" placeholder="Enter Address"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="gender" class="col-sm-4 col-form-label text-end">Gender</label>
                    <div class="col-sm-6">
                        <input type="text" id="gender" name="gender" placeholder="Enter Gender"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="birthday" class="col-sm-4 col-form-label text-end">Birthday</label>
                    <div class="col-sm-6">
                        <input type="text" id="birthday" name="birthday" placeholder="Enter Birthday"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="position" class="col-sm-4 col-form-label text-end">Position</label>
                    <div class="col-sm-6">
                        <!-- <input type="text" id="position" name="position" placeholder="Enter Position"
                            class="form-control form-control-sm" required /> -->
                        <!-- <label for="position">Choose your position:</label> -->
                        <select id="position" name="position" class="form-control form-control-sm">
                            <option value="user">user</option>
                            <option value="admin">admin</option>

                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="IDnumber" class="col-sm-4 col-form-label text-end">IDnumber</label>
                    <div class="col-sm-6">
                        <input type="text" id="IDnumber" name="IDnumber" placeholder="Enter IDnumber"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="age" class="col-sm-4 col-form-label text-end">age</label>
                    <div class="col-sm-6">
                        <input type="number" id="age" name="age" placeholder="enter your age"
                            class="form-control form-control-sm" required />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Yearlevel" class="col-sm-4 col-form-label text-end">Yearlevel</label>
                    <div class="col-sm-6">
                        <input type="Yearlevel" id="Yearlevel" name="Yearlevel" placeholder="Enter Yearlevel"
                            class="form-control form-control-sm" required />
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <p class="mt-2">Already have an account? <a href="index.php" style="color: #333;">Login here</a>
                        </p>
                    </div>
            </form>
        </div>
    </div>
</body>

</html>