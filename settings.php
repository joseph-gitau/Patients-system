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
                <!-- dashboard -->
                <div id="dashboard">
                    <h2 class="page-head">Profile settings</h2>
                    <hr>
                    <div class="main">
                        <?php
                        $id = $_SESSION['id'];
                        // connect to database
                        include './dbh.php';
                        // get user details
                        $sql = "SELECT * FROM user_doctor WHERE id = '$id'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $username = $row['username'];
                        $email = $row['email'];
                        $phone_no = $row['phone_no'];
                        $address = $row['address'];
                        ?>
                        <div class="form">
                            <?php
                            // if session has error message, display it
                            if (isset($_SESSION['error'])) {
                                echo "<div class='error'>" . $_SESSION['error'] . "</div>";
                                unset($_SESSION['error']);
                            }
                            // if session has success message, display it
                            if (isset($_SESSION['success'])) {
                                echo "<div class='success'>" . $_SESSION['success'] . "</div>";
                                unset($_SESSION['success']);
                            }
                            ?>
                            <form action="./reg_exe.php" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" value="<?php echo $username; ?>">
                                </div>
                                <!-- email -->
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $email; ?>">
                                </div>
                                <!-- phone_no -->
                                <div class="form-group">
                                    <label for="phone_no">Phone Number</label>
                                    <input type="text" name="phone_no" id="phone_no" value="<?php echo $phone_no; ?>">
                                </div>
                                <!-- address -->
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" value="<?php echo $address; ?>">
                                </div>

                                <!-- save button -->
                                <div class="submit">
                                    <button type="submit" class="btn" name="update_profile">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!-- script -->
        <script src="js/index.js"></script>
</body>

</html>