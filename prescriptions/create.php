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
                ?>
                <!-- dashboard -->
                <div id="dashboard">
                    <h2 class="page-head">Add new prescriptions</h2>
                    <hr>
                    <div class="main">
                        <!-- nw -->
                        <div class="dash-bottom">
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
                            $action_base = $_GET['t'];
                            if ($action_base == 'new') {
                                $action = 'create';
                            } elseif ($action_base == 'edit') {
                                $action = 'edit';
                            } elseif ($action_base == 'view') {
                                $action = 'view';
                            } else {
                                $action = 'not set';
                            }
                            ?>
                            <?php if ($action == "create") {
                                // get the patients under the doctor
                                include '../dbh.php';
                                $user_id = $_SESSION['id'];
                                $sql = "SELECT * FROM user_patient WHERE doctor_id = '$user_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);


                            ?>
                                <form action="../reg_exe.php" method="post">
                                    <div class="form-group">
                                        <label for="test_name">Select patient</label>
                                        <select name="patient_id" id="patient_id">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- date -->
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="appointment_date" id="date" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <!-- drug -->
                                    <div class="form-group">
                                        <?php
                                        // get the drugs under the doctor
                                        include '../dbh.php';
                                        $user_id = $_SESSION['id'];
                                        $sql = "SELECT * FROM drugs WHERE doctor_id = '$user_id'";
                                        $result = mysqli_query($conn, $sql);

                                        ?>
                                        <label for="drug_name">Select drug</label>
                                        <select name="drug_id" id="drug_id">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['trade_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- dosage -->
                                    <div class="form-group">
                                        <label for="dosage">Dosage</label>
                                        <input type="text" name="dosage" id="dosage">
                                    </div>
                                    <!-- frequency -->
                                    <div class="form-group">
                                        <label for="frequency">Frequency</label>
                                        <input type="text" name="frequency" id="frequency">
                                    </div>
                                    <!-- tests -->
                                    <div class="form-group">
                                        <?php
                                        // get the tests under the doctor
                                        include '../dbh.php';
                                        $user_id = $_SESSION['id'];
                                        $sql = "SELECT * FROM tests WHERE doctor_id = '$user_id'";
                                        $result = mysqli_query($conn, $sql);

                                        ?>
                                        <label for="test_name">Select tests</label>
                                        <select name="test_name" id="test_name">
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>"><?php echo $row['test_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <!-- notes -->
                                    <div class="form-group">
                                        <label for="notes">Notes</label>
                                        <textarea name="notes" id="notes" cols="30" rows="10"></textarea>
                                    </div>

                                    <!-- save button -->
                                    <div class="submit">
                                        <button type="submit" class="btn" name="add_prescription">Add a new prescription</button>
                                    </div>
                                </form>
                                <!-- nw -->
                            <?php
                            }
                            if ($action == "edit") {
                                include '../dbh.php';
                                $edit_id = $_GET['id'];
                                $sql = "SELECT * FROM user_patient WHERE id = '$edit_id'";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_assoc($result);

                            ?>
                                <!-- nw -->
                                <form action="../reg_exe.php" method="post">
                                    <div class="form-group">
                                        <label for="username">Patient name</label>
                                        <input type="text" name="name" id="name" value="<?php echo $row['name']; ?>">
                                        <input type="hidden" value="<?php echo $edit_id; ?>">
                                    </div>
                                    <!-- email -->
                                    <div class="form-group">
                                        <label for="email">Patient's Email</label>
                                        <input type="email" name="email" id="email" value="<?php echo $row['email']; ?>">
                                    </div>
                                    <!-- phone_no -->
                                    <div class="form-group">
                                        <label for="phone_no">Patient's Phone Number</label>
                                        <input type="text" name="phone_no" id="phone_no" value="<?php echo $row['phone_no']; ?>">
                                    </div>
                                    <!-- birthday -->
                                    <div class="form-group">
                                        <label for="birthday">Patient's Birthday</label>
                                        <input type="date" name="birthday" id="birthday" value="<?php echo $row['birthday']; ?>">
                                    </div>
                                    <!-- gender -->
                                    <div class="form-group">
                                        <select name="gender" id="gender">
                                            <?php
                                            $tp_gender = $row['gender'];
                                            if ($tp_gender == "Male") {
                                                echo '<option selected value="Male">Male</option>
                                                <option value="Female">Female</option>
                                                ';
                                            } elseif ($tp_gender == "Female") {
                                                echo '
                                                <option value="Male">Male</option>
                                                <option selected value="Female">Female</option>';
                                            } else {
                                                echo '
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- bloodgroup -->
                                    <div class="form-group">
                                        <?php
                                        $tp_bloodgroup = $row['bloodgroup'];
                                        // script for bloodgroup select option
                                        if ($tp_bloodgroup == "A+") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option selected value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "A-") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option selected value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "B+") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option selected value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "B-") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option selected value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "AB+") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option selected value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "AB-") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option selected value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "O+") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option selected value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        } elseif ($tp_bloodgroup == "O-") {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option selected value="O-">O-</option>
                                        </select>';
                                        } else {
                                            echo '<select name="bloodgroup" id="bloodgroup_edit">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>';
                                        }
                                        ?>
                                    </div>
                                    <!-- address -->
                                    <div class="form-group">
                                        <label for="address">Patient's Address</label>
                                        <input type="text" name="address" id="address" value="<?php echo $row['address']; ?>">
                                    </div>
                                    <!-- weight -->
                                    <div class="form-group">
                                        <label for="weight">Patient's Weight</label>
                                        <input type="text" name="weight" id="weight" value="<?php echo $row['weight']; ?>">
                                    </div>
                                    <!-- height -->
                                    <div class="form-group">
                                        <label for="height">Patient's Height</label>
                                        <input type="text" name="height" id="height" value="<?php echo $row['height']; ?>">
                                    </div>

                                    <!-- save button -->
                                    <div class="submit">
                                        <button type="submit" class="btn" name="update_patient">update</button>
                                    </div>
                                </form>
                                <!-- /nw -->
                            <?php
                            }
                            ?>
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