<?php
require 'db_config.php'; // Include the database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];

    try {
        // Prepare SQL query to insert data into the database
        $stmt = $conn->prepare("INSERT INTO personal_info (name, age, gender) VALUES (:name, :age, :gender)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':gender', $gender);
        $stmt->execute();

        // Redirect back to the form or display success message
        header("Location: trial.html?success=1");
        exit();
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}
?>
