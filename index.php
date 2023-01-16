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
                    <a href="#">
                        <span>John Smith</span>
                        <img src="images/user.png" alt="profile">
                    </a>

                </div>
            </nav>
            <!-- content -->
            <div class="content">
                <div class="title">
                    <h1>Dashboard</h1>
                </div>
                <div class="dashboard">
                    <div class="box">
                        <div class="box-title">
                            <h1>Patients</h1>
                        </div>
                        <div class="box-content">
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Total Patients</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Active Patients</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Inactive Patients</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-title">
                            <h1>Appointments</h1>
                        </div>
                        <div class="box-content">
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Total Appointments</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Active Appointments</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Inactive Appointments</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-title">
                            <h1>Prescriptions</h1>
                        </div>
                        <div class="box-content">
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Total Prescriptions</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Active Prescriptions</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Inactive Prescriptions</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-title">
                            <h1>Drugs</h1>
                        </div>
                        <div class="box content">
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Total Drugs</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Active Drugs</p>
                            </div>
                            <div class="box-content-item">
                                <h1>100</h1>
                                <p>Inactive Drugs</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- script -->
    <script src="js/script.js"></script>
</body>

</html>