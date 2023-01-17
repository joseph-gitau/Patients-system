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
                    <h2 class="page-head">Tests Records</h2>
                    <hr>
                    <div class="main">
                        <!-- nw -->
                        <div class="dash-bottom">
                            <div class="dash-b-head">
                                <h4 class="hidden">sp</h4>
                                <button class="btn"><a href="./create.php?t=new">Add new test</a></button>
                            </div>

                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Test name</th>
                                        <th>Test description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include '../dbh.php';
                                    $doctor_id = $_SESSION['id'];
                                    $sql = "SELECT * FROM tests WHERE doctor_id = '$doctor_id'";
                                    $result = mysqli_query($conn, $sql);
                                    $resultCheck = mysqli_num_rows($result);
                                    if ($resultCheck > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '
                                           <tr>
                                                <td>' . $row['id'] . '</td>
                                                <td>' . $row['test_name'] . '</td>
                                                <td>' . $row['description'] . '</td>
                                                <td>
                                                    <a href="../create.php?t=view&id=' . $row['id'] . '" class="btn-link">View</a>
                                                    <a href="../create.php?t=edit&id=' . $row['id'] . '" class="btn-link">Edit</a>
                                                    <a href="#" class="btn-link">Delete</a>
                                                </td>
                                            </tr>
                                        ';
                                        }
                                    } else {
                                        echo '
                                        <tr>
                                            <td colspan="7">No records found</td>
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