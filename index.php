<?php
session_start();
// check if user is logged in
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ./auth/login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Patient Information Management System (OPIMS):</title>

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">

        <div class="left">
            <!-- include sidebar -->
            <?php include 'sidebar.php'; ?>
        </div>
        <div class="right">
            <nav>

                <!-- profile icon -->
                <div class="profile">
                    <a href="#" id="dropdown-toggle">
                        <span>Hello, <?php echo $_SESSION['username']; ?></span>
                        <img src="images/user.png" alt="profile">
                    </a>
                    <div id="dropdown-menu">
                        <a href="/settings">Profile Settings</a>
                        <a href="./auth/logout.php">Logout</a>
                    </div>
                </div>

            </nav>
            <hr>
            <!-- content -->
            <div class="content">
                <?php
                // if session has success message, display it
                if (isset($_SESSION['success'])) {
                    echo "<div class='success'>" . $_SESSION['success'] . "</div>";
                    unset($_SESSION['success']);
                }
                ?>
                <!-- dashboard -->
                <div id="dashboard">
                    <h2>Dashboard</h2>
                    <div class="main">
                        <div class="dash-top">
                            <div class="card">
                                <div class="card-header">
                                    <h4>New appointments</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $_SESSION['id'] ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total appointments</h4>
                                </div>
                                <div class="card-body">
                                    <h1>0</h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>New Patients</h4>
                                </div>
                                <div class="card-body">
                                    <h1>0</h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Patients</h4>
                                </div>
                                <div class="card-body">
                                    <h1>0</h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Prescriptions</h4>
                                </div>
                                <div class="card-body">
                                    <h1>0</h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total payment</h4>
                                </div>
                                <div class="card-body">
                                    <h1>0</h1>
                                </div>
                            </div>
                        </div>
                        <!-- nw -->
                        <div class="dash-bottom">
                            <div class="dash-b-head">
                                <h4>Appointments lists</h4>
                                <button class="btn">Add new</button>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient Name</th>
                                        <th>Date</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time</th>
                                        <th>Appointment Status</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Smith</td>
                                        <td>2021-09-01</td>
                                        <td>2021-09-01</td>
                                        <td>10:00 AM</td>
                                        <td>Active</td>
                                        <td>2021-09-01 10:00:00</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>John Smith</td>
                                        <td>2021-09-01</td>
                                        <td>2021-09-01</td>
                                        <td>10:00 AM</td>
                                        <td>Active</td>
                                        <td>2021-09-01 10:00:00</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>John Smith</td>
                                        <td>2021-09-01</td>
                                        <td>2021-09-01</td>
                                        <td>10:00 AM</td>
                                        <td>Active</td>
                                        <td>2021-09-01 10:00:00</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>John Smith</td>
                                        <td>2021-09-01</td>
                                        <td>2021-09-01</td>
                                        <td>10:00 AM</td>
                                        <td>Active</td>
                                        <td>2021-09-01 10:00:00</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>John Smith</td>
                                        <td>2021-09-01</td>
                                        <td>2021-09-01</td>
                                        <td>10:00 AM</td>
                                        <td>Active</td>
                                        <td>2021-09-01 10:00:00</td>
                                        <td>
                                            <a href="#">Edit</a>
                                            <a href="#">Delete</a>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <!-- patients -->
                <div id="patients">
                    <h2>Patients</h2>
                </div>
                <!-- appointments -->
                <div id="appointments">
                    <h2>Appointments</h2>
                </div>
                <!-- prescriptions -->
                <div id="prescriptions">
                    <h2>Prescriptions</h1>
                </div>
                <!-- drugs -->
                <div id="drugs">
                    <h2>Drugs</h2>
                </div>
                <!-- tests -->
                <div id="tests">
                    <h2>Tests</h2>
                </div>
                <!-- billing -->
                <div id="billing">
                    <h2>Billing</h2>
                </div>
                <!-- reports -->
                <div id="reports">
                    <h2>Reports</h2>
                </div>
                <!-- settings -->
                <div id="settings">
                    <h2>Settings</h2>
                </div>
            </div>

        </div>
    </div>

    <!-- script -->
    <script src="js/index.js"></script>
</body>

</html>