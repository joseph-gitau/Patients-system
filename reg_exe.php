<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array();

// connect to the database
$server = "localhost";
$username = "root";
$password = "";
$connname = "patient_system";

// Create connection
$conn = mysqli_connect($server, $username, $password, $connname);

// REGISTER USER
if (isset($_POST['register_user'])) {
    // receive all input values from the form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

    // form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }
    if (count($errors) == 0) {

        // first check the database to make sure 
        // a user does not already exist with the same username and/or email
        $user_check_query = "SELECT * FROM user_doctor WHERE username='$username' OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }

            if ($user['email'] === $email) {
                array_push($errors, "email already exists");
            }
        }

        // register user 

        $password = md5($password_1); //encrypt the password before saving in the database

        $query = "INSERT INTO user_doctor (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in!";

        // get the id of the user
        $id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM user_doctor WHERE username='$username' AND email = '$email'"))['id'];
        $_SESSION['id'] = $id;
        header('location: index.php');
    } else {
        // redirect to the registration page with errors
        $_SESSION['errors'] = $errors;
        header('location: ./auth/register.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM user_doctor WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        // get the id of the user
        $id = mysqli_fetch_assoc($results)['id'];
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $id;
            $_SESSION['success'] = "You are now logged in!";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    } else {
        // redirect to the registration page with errors
        $_SESSION['errors'] = $errors;
        header('location: ./auth/login.php');
    }
}