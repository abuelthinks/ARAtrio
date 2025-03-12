<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Allow CORS
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

try {
    // Get POST data
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        throw new Exception('No data received');
    }

    // Database connection
    $host = 'localhost';  // or your database host
    $dbname = 'your_database_name';
    $username = 'your_username';
    $password = 'your_password';

    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $sql = "INSERT INTO assessments (
        child_name, 
        dob, 
        grade_level, 
        gender, 
        parent_name, 
        phone, 
        email, 
        primary_language,
        medical_conditions,
        areas_of_concern,
        primary_concerns,
        child_goals,
        successful_strategies,
        submission_date
    ) VALUES (
        :child_name,
        :dob,
        :grade_level,
        :gender,
        :parent_name,
        :phone,
        :email,
        :primary_language,
        :medical_conditions,
        :areas_of_concern,
        :primary_concerns,
        :child_goals,
        :successful_strategies,
        NOW()
    )";

    $stmt = $pdo->prepare($sql);

    // Execute with data
    $stmt->execute([
        'child_name' => $data['childName'] ?? null,
        'dob' => $data['dob'] ?? null,
        'grade_level' => $data['gradeLevel'] ?? null,
        'gender' => $data['gender'] ?? null,
        'parent_name' => $data['parentName'] ?? null,
        'phone' => $data['phone'] ?? null,
        'email' => $data['email'] ?? null,
        'primary_language' => $data['primaryLanguage'] ?? null,
        'medical_conditions' => json_encode($data['medicalConditions'] ?? []),
        'areas_of_concern' => json_encode($data['areasOfConcern'] ?? []),
        'primary_concerns' => $data['primaryConcerns'] ?? null,
        'child_goals' => $data['childGoals'] ?? null,
        'successful_strategies' => $data['successfulStrategies'] ?? null
    ]);

    // Send success response
    echo json_encode(['success' => true, 'message' => 'Assessment saved successfully']);

} catch (Exception $e) {
    // Send error response
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?> 