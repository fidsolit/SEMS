<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not, redirect to the login page
    header('Location: index.php');
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Event Management System</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #343a40;
            color: #fff;
            min-height: 100vh;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
            text-decoration: none;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            color: #fff;
        }

        .card img {
            width: 50px;
            height: 50px;
        }

        .card .card-body {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .card.bg-participants {
            background-color: #17a2b8;
        }

        .card.bg-organizers {
            background-color: #fd7e14;
        }

        .card.bg-administrators {
            background-color: #dc3545;
        }

        .card.bg-events {
            background-color: #28a745;
        }

        .card.bg-completed {
            background-color: #ffc107;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="sidebar-sticky">
                    <h4 class="text-center mt-4">School Event Management System</h4>
                    <ul class="nav flex-column mt-4">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <img src="https://img.icons8.com/ios-filled/50/ffffff/home.png" />
                                Home
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2 flex">
                            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                            <a href="logout.php" class="btn "> <button type="button"
                                    class="btn btn-sm btn-outline-secondary">Log Out</button></a>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card bg-participants">
                            <div class="card-body">
                                <img src="https://img.icons8.com/ios-filled/50/000000/graduation-cap.png" />
                                <div>
                                    <h5 class="card-title">150</h5>
                                    <p class="card-text">No. of Participants</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-organizers">
                            <div class="card-body">
                                <img src="https://img.icons8.com/ios-filled/50/000000/teacher.png" />
                                <div>
                                    <h5 class="card-title">5</h5>
                                    <p class="card-text">Organizer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-administrators">
                            <div class="card-body">
                                <img src="https://img.icons8.com/ios-filled/50/000000/admin-settings-male.png" />
                                <div>
                                    <h5 class="card-title">3</h5>
                                    <p class="card-text">Administrator</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-events">
                            <div class="card-body">
                                <img src="https://img.icons8.com/ios-filled/50/000000/calendar.png" />
                                <div>
                                    <h5 class="card-title">11</h5>
                                    <p class="card-text">No. of Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card bg-completed">
                            <div class="card-body">
                                <img src="https://img.icons8.com/ios-filled/50/000000/checked.png" />
                                <div>
                                    <h5 class="card-title">2</h5>
                                    <p class="card-text">No. of Completed Events</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- <div class="">
            <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        
        </div> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>