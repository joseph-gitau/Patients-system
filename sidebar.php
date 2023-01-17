<div class="sidebar">
    <!-- title -->
    <div class="title">
        <h1>OPIMS</h1>
    </div>
    <!-- navigation -->
    <div class="navigation">
        <ul>
            <?php
            $path_old =  dirname(__FILE__);
            $path2 = str_replace("\\", "/", $path_old);
            $path = str_replace($_SERVER['DOCUMENT_ROOT'], "", $path2);
            ?>

            <li><a href="<?php echo $path; ?>/index.php">Dashboard</a></li>
            <li><a href="<?php echo $path; ?>/patients/patients.php">Patients</a></li>
            <li><a href="<?php echo $path; ?>/appointments/appointments.php">Appointments</a></li>
            <li><a href="<?php echo $path; ?>/prescriptions/prescriptions.php">Prescriptions</a></li>
            <li><a href="<?php echo $path; ?>/drugs/drugs.php">Drugs</a></li>
            <li><a href="<?php echo $path; ?>/tests/tests.php">Tests</a></li>
            <li><a href="<?php echo $path; ?>/billing">Billing</a></li>
            <li><a href="<?php echo $path; ?>/reports">Reports</a></li>
            <li><a href="<?php echo $path; ?>/settings.php">Profile Settings</a></li>
        </ul>
    </div>
</div>