<?php
// database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "patient_system";

// Create connection
$conn = mysqli_connect($server, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
