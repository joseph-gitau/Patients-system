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

            <li>
                <span class="sidebar-head-txt">Dashboard</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/index.php">Dashboard</a>
            </li>
            <li>
                <span class="sidebar-head-txt">Patients</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/patients/patients.php">&gt; All patients</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/patients/create.php?t=new">&gt; Add new patient</a>
            </li>
            <li>
                <span class="sidebar-head-txt">Appointments</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/appointments/appointments.php">&gt; Appointments</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/appointments/create.php?t=new">&gt; Add a new appointment</a>
            </li>
            <li>
                <span class="sidebar-head-txt">Prescriptions</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/prescriptions/prescriptions.php">&gt; Prescriptions</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/prescriptions/create.php?t=new">&gt; Add a new Prescription</a><br>
            </li>
            <li>
                <span class="sidebar-head-txt">Drugs</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/drugs/drugs.php">&gt; Drugs</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/drugs/create.php?t=new">&gt; Add a new Drug</a><br>
            </li>
            <li>
                <span class="sidebar-head-txt">Tests</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/tests/tests.php">&gt; Tests</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/tests/create.php?t=new">&gt; Add a new Test</a><br>
            </li>
            <li>
                <span class="sidebar-head-txt">Billing</span><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/billing/billing.php">&gt; Billing</a><br>
                <a class="sidebar-head-txt-sub" href="<?php echo $path; ?>/billing/create.php?t=new">&gt; Add a new invoice</a><br>
            </li>
            <li><a href="<?php echo $path; ?>/reports">&gt; Reports</a></li>
            <li><a href="<?php echo $path; ?>/settings.php">&gt; Profile Settings</a></li>

        </ul>
    </div>
</div>