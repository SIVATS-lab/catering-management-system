<?php
// Database configuration
$host = 'localhost';
$user = 'root'; // Change as needed
$pass = ''; // Change as needed
$dbname = 'catering_pro';

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset
$conn->set_charset("utf8");
?>