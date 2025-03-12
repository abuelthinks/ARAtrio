<?php
// Database configuration
$host = "localhost"; // Change if using a remote database
$dbname = "trial_db";
$username = "root"; // Replace with your database username
$password = "ara6ara18&$"; // Replace with your database password

// Create a database connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>


