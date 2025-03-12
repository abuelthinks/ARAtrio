CREATE DATABASE IF NOT EXISTS child_assessment_db;
USE child_assessment_db;

CREATE TABLE IF NOT EXISTS child_assessments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    report_id VARCHAR(13) UNIQUE,
    child_name VARCHAR(100),
    dob DATE,
    iep_start_date DATE,
    grade_level VARCHAR(50),
    gender VARCHAR(10),
    parent_name VARCHAR(100),
    phone VARCHAR(20),
    email VARCHAR(100),
    primary_language VARCHAR(50),
    medical_conditions JSON,
    sat_age VARCHAR(20),
    crawl_age VARCHAR(20),
    walk_age VARCHAR(20),
    first_words_age VARCHAR(20),
    sentences_age VARCHAR(20),
    previous_school VARCHAR(100),
    special_ed VARCHAR(5),
    iep VARCHAR(5),
    areas_of_concern JSON,
    typical_behavior TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
