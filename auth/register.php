<?php
// if seession is not started, start it

if (!isset($_SESSION)) {
    session_start();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>OPIMS Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>OPIMS Register</h2>
    </div>

    <form method="post" action="../reg_exe.php">
        <?php
        include '../reg_exe.php';
        // if $_session[$errors] is set, display it
        if (isset($_SESSION['errors'])) {
            // loop through the errors
            foreach ($_SESSION['errors'] as $error) {
                echo "<p class='error'>" . $error . "</p>";
            }
            // unset the errors
            unset($_SESSION['errors']);
        }
        ?>
        <div class="input-group">
            <label>Username</label>
            <input type="text" name="username" value="">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="register_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>

</html>