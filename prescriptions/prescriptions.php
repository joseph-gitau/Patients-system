<?php
session_start();
// check if user is logged in
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../auth/login.php');
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
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">

        <div class="left">
            <!-- include sidebar -->
            <?php include '../sidebar.php'; ?>
        </div>
        <div class="right">
            <nav>

                <!-- profile icon -->
                <div class="profile">
                    <a href="#" id="dropdown-toggle">
                        <span>Hello, <?php echo $_SESSION['username']; ?></span>
                        <img src="../images/user.png" alt="profile">
                    </a>
                    <div id="dropdown-menu">
                        <a href="../settings">Profile Settings</a>
                        <a href="../auth/logout.php">Logout</a>
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
                // if session has error message, display it
                if (isset($_SESSION['errors'])) {
                    echo "<div class='error'>" . $_SESSION['errors'] . "</div>";
                    unset($_SESSION['errors']);
                }
                ?>
                <!-- dashboard -->
                <div id="dashboard">
                    <h2 class="page-head">Prescriptions Records</h2>
                    <hr>
                    <div class="main">
                        <!-- nw -->
                        <div class="dash-bottom">
                            <div class="dash-b-head">
                                <h4 class="hidden">sp</h4>
                                <button class="btn"><a href="./create.php?t=new">Add a new prescription</a></button>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Date</th>
                                        <th>Drug name</th>
                                        <th>Contents</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../dbh.php';
                                    $doctor_id = $_SESSION['id'];
                                    $sql = "SELECT * FROM prescriptions WHERE doctor_id = '$doctor_id'";
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);
                                    if ($resultCheck > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // get patient name
                                            $patient_id = $row['patient'];
                                            $sql = "SELECT * FROM user_patient WHERE id = '$patient_id'";
                                            $result2 = mysqli_query($conn, $sql);
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $patient_name = $row2['name'];
                                            // get drug_name
                                            $drug_id = $row['drug_id'];
                                            $sql1 = "SELECT * FROM drugs WHERE id = '$drug_id'";
                                            $result1 = mysqli_query($conn, $sql1);
                                            $row1 = mysqli_fetch_assoc($result1);
                                            $drug_name = $row1['trade_name'];
                                            echo '
                                           <tr>
                                                <td>' . $row['id'] . '</td>
                                                <td>' . $patient_name . '</td>
                                                <td>' . $row['date'] . '</td>
                                                <td>' . $drug_name . '</td>
                                                <td>' . $row['content'] . '</td>
                                                <td>
                                                    <a href="./create.php?t=view&id=' . $row['id'] . '" class="btn-link">View</a>
                                                    <a href="./create.php?t=edit&id=' . $row['id'] . '" class="btn-link">Edit</a>
                                                    <a href="#" class="btn-link">Delete</a>
                                                </td>
                                            </tr>
                                        ';
                                        }
                                    } else {
                                        echo '
                                        <tr>
                                            <td colspan="5">No prescriptions found</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- script -->
    <script src="../js/index.js"></script>
</body>

</html>