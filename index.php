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
                    <h2 class="page-head">Dashboard</h2>
                    <hr>
                    <div class="main">
                        <div class="dash-top">
                            <?php
                            // get new appointments
                            $user_id = $_SESSION['id'];
                            // connect to database
                            include './dbh.php';
                            $query = "SELECT * FROM appointments WHERE doctor_id = '$user_id' AND status = 'pending'";
                            $result = mysqli_query($conn, $query);
                            $new_appointments = mysqli_num_rows($result);
                            // total appointments
                            $query1 = "SELECT * FROM appointments WHERE doctor_id = '$user_id'";
                            $result1 = mysqli_query($conn, $query1);
                            $total_appointments = mysqli_num_rows($result1);
                            // new patients
                            $query2 = "SELECT * FROM user_patient WHERE doctor_id = '$user_id'";
                            $result2 = mysqli_query($conn, $query2);
                            $new_patients = mysqli_num_rows($result2);
                            // total prescriptions
                            $query3 = "SELECT * FROM prescriptions WHERE doctor_id = '$user_id'";
                            $result3 = mysqli_query($conn, $query3);
                            $total_prescriptions = mysqli_num_rows($result3);
                            // total amount paid
                            $query4 = "SELECT * FROM billing WHERE doctor_id = '$user_id' AND payment_status = 'paid'";
                            $result4 = mysqli_query($conn, $query4);
                            $total_amount_paid = mysqli_num_rows($result4);
                            if ($total_amount_paid > 0) {
                                $all_total = 0;
                                while ($row = mysqli_fetch_assoc($result4)) {
                                    $all_total += $row['amount'];
                                }
                            } else {
                                $all_total = 0;
                            }

                            ?>
                            <div class="card">
                                <div class="card-header">
                                    <h4>New appointments</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $new_appointments; ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total appointments</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $total_appointments; ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>New Patients</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo  $new_patients; ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Patients</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo  $new_patients; ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total Prescriptions</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $total_prescriptions; ?></h1>
                                </div>
                            </div>
                            <!-- nw -->
                            <div class="card">
                                <div class="card-header">
                                    <h4>Total payment</h4>
                                </div>
                                <div class="card-body">
                                    <h1><?php echo $all_total; ?> Ksh</h1>
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
                                    <?php
                                    // get all appointments under this doctor
                                    $query_apoint = "SELECT * FROM appointments WHERE doctor_id = '$user_id'";
                                    $result_apoint = mysqli_query($conn, $query_apoint);
                                    $row_apoint = mysqli_num_rows($result_apoint);
                                    if ($row_apoint > 0) {
                                        while ($row = mysqli_fetch_assoc($result_apoint)) {
                                            $patient_id = $row['patient'];
                                            $query_patient = "SELECT * FROM user_patient WHERE id = '$patient_id'";
                                            $result_patient = mysqli_query($conn, $query_patient);
                                            $row_patient = mysqli_fetch_assoc($result_patient);
                                            $patient_name = $row_patient['name'];
                                            $date = $row['date'];
                                            $appointment_date = $row['date'];
                                            $appointment_time = $row['timeslot'];
                                            $status = $row['status'];
                                            $created_at = $row['created_at'];
                                            $id = $row['id'];
                                            echo "<tr>
                                        <td>$id</td>
                                        <td>$patient_name</td>
                                        <td>$date</td>
                                        <td>$appointment_date</td>
                                        <td>$appointment_time</td>
                                        <td>$status</td>
                                        <td>$created_at</td>
                                        <td>
                                            <a href='#'>Edit</a>
                                            <a href='#'>Delete</a>
                                        </td>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8'>No appointments found</td></tr>";
                                    }

                                    ?>
                                    <!-- <tr>
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
                                    </tr> -->
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- script -->
    <script src="js/index.js"></script>
</body>

</html>