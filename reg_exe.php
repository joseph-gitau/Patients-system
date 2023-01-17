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
// update user details
if (isset($_POST['update_profile'])) {
    $id = $_SESSION['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $query = "UPDATE user_doctor SET username='$username', email='$email', phone_no='$phone_no', address='$address' WHERE id='$id'";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Profile updated successfully!";
        header('location: ./settings.php');
    } else {
        $_SESSION['errors'] = "Error updating profile!";
        header('location: ./settings.php');
    }
}
// add new patient
if (isset($_POST['add_patient'])) {
    $doctor_id = $_SESSION['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birthday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['bloodgroup']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);

    $query = "INSERT INTO user_patient (doctor_id, name, email, phone_no, birthday, gender, bloodgroup, address, weight, height) VALUES('$doctor_id', '$name', '$email', '$phone_no', '$birth_date', '$gender', '$blood_group', '$address', '$weight', '$height')";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Patient added successfully!";
        header('location: ./patients/patients.php');
    } else {
        // get the actual error
        //$_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error adding patient!";
        header('location: ./patients/patients.php');
    }
}
// update patient details
if (isset($_POST['update_patient'])) {
    $id = $_SESSION['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone_no = mysqli_real_escape_string($conn, $_POST['phone_no']);
    $birth_date = mysqli_real_escape_string($conn, $_POST['birthday']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['bloodgroup']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $height = mysqli_real_escape_string($conn, $_POST['height']);

    $query = "UPDATE user_patient SET id='$id', name='$name', email='$email', phone_no='$phone_no', birthday='$birth_date', gender='$gender', bloodgroup='$blood_group', address='$address', weight='$weight', height='$height' WHERE id='$id'";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Patient record updated successfully!";
        header('location: ./patients/patients.php');
    } else {
        // $_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error updating patient record!";
        header('location: ./patients/patients.php');
    }
}
// add_drug
if (isset($_POST['add_drug'])) {
    $doctor_id = $_SESSION['id'];
    $trade_name = mysqli_real_escape_string($conn, $_POST['trade_name']);
    $generic_name = mysqli_real_escape_string($conn, $_POST['generic_name']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);

    $query = "INSERT INTO drugs (doctor_id, trade_name, generic_name, note) VALUES('$doctor_id', '$trade_name', '$generic_name', '$note')";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Drug added successfully!";
        header('location: ./drugs/drugs.php');
    } else {
        // get the actual error
        //$_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error adding drug!";
        header('location: ./drugs/drugs.php');
    }
}
// add_test
if (isset($_POST['add_test'])) {
    $doctor_id = $_SESSION['id'];
    $test_name = mysqli_real_escape_string($conn, $_POST['test_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $query = "INSERT INTO tests (doctor_id, test_name, description) VALUES('$doctor_id', '$test_name', '$description')";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Test added successfully!";
        header('location: ./tests/tests.php');
    } else {
        // get the actual error
        //$_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error adding test!";
        header('location: ./tests/tests.php');
    }
}
// add_appointment
if (isset($_POST['add_appointment'])) {
    $doctor_id = $_SESSION['id'];
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $appointment_date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $timeslot = mysqli_real_escape_string($conn, $_POST['timeslot']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $query = "INSERT INTO appointments (doctor_id, patient, date, timeslot, status) VALUES('$doctor_id', '$patient_id', '$appointment_date', '$timeslot', '$status')";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Appointment added successfully!";
        header('location: ./appointments/appointments.php');
    } else {
        // get the actual error
        // $_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error adding appointment!";
        header('location: ./appointments/appointments.php');
    }
}
// add_prescription
if (isset($_POST['add_prescription'])) {
    $doctor_id = $_SESSION['id'];
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    $date = mysqli_real_escape_string($conn, $_POST['appointment_date']);
    $drug_id = mysqli_real_escape_string($conn, $_POST['drug_id']);
    $dosage = mysqli_real_escape_string($conn, $_POST['dosage']);
    $frequency = mysqli_real_escape_string($conn, $_POST['frequency']);
    $test_id = mysqli_real_escape_string($conn, $_POST['test_name']);
    $note = mysqli_real_escape_string($conn, $_POST['notes']);

    $query = "INSERT INTO prescriptions (doctor_id, patient, date, drug_id, dosage, frequency, test_id, content) VALUES('$doctor_id', '$patient_id', '$date', '$drug_id', '$dosage', '$frequency', '$test_id', '$note')";
    $results = mysqli_query($conn, $query);
    if ($results) {
        $_SESSION['success'] = "Prescription added successfully!";
        header('location: ./prescriptions/prescriptions.php');
    } else {
        // get the actual error
        // $_SESSION['errors'] = mysqli_error($conn);
        $_SESSION['errors'] = "Error adding prescription!";
        header('location: ./prescriptions/prescriptions.php');
    }
}
