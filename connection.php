<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "database-2.c9ma6ocoedh5.eu-west-2.rds.amazonaws.com"; // Database server address
$username = "admin";        // Database username
$password = "";            // Database password
$database = "customer_details"; // Name of your database

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

