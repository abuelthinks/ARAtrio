<?php
// Database connection
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$childName = $_POST['childName'];
$gender = $_POST['gender'];
// Add all other form fields here...

// Prepare SQL statement
$sql = "INSERT INTO specialist_assessments (
    child_name, 
    gender,
    reading_skill,
    writing_skill,
    mathematics_skill,
    expressive_language,
    receptive_language,
    social_communication,
    fine_motor,
    gross_motor,
    attention,
    impulse_control,
    social_interaction,
    emotional_regulation,
    strengths,
    additional_info
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssss", 
    $childName, 
    $gender,
    $_POST['reading'],
    $_POST['writing'],
    $_POST['mathematics'],
    $_POST['expressive'],
    $_POST['receptive'],
    $_POST['social'],
    $_POST['fine'],
    $_POST['gross'],
    $_POST['attention'],
    $_POST['impulse'],
    $_POST['interaction'],
    $_POST['emotional'],
    $_POST['strengths'],
    $_POST['additionalInfo']
);

// Execute the statement
if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?> 