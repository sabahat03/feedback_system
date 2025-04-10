
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "feedback_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data and sanitize inputs
$student_name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : '';
$faculty_name = isset($_POST['faculty_name']) ? $conn->real_escape_string(trim($_POST['faculty_name'])) : '';
$subject_name = isset($_POST['subject_name']) ? $conn->real_escape_string(trim($_POST['subject_name'])) : '';
$topics_covered = isset($_POST['topics_covered']) ? $conn->real_escape_string(trim($_POST['topics_covered'])) : '';
$content_delivery_method = isset($_POST['content_delivery_method']) ? $conn->real_escape_string(trim($_POST['content_delivery_method'])) : '';

// Get ratings
$on_time_rating = isset($_POST['on_time_rating']) ? intval($_POST['on_time_rating']) : 0;
$well_prepared_rating = isset($_POST['well_prepared_rating']) ? intval($_POST['well_prepared_rating']) : 0;
$english_communication_rating = isset($_POST['english_communication_rating']) ? intval($_POST['english_communication_rating']) : 0;
$explains_clearly_rating = isset($_POST['explains_clearly_rating']) ? intval($_POST['explains_clearly_rating']) : 0;
$real_world_applications_rating = isset($_POST['real_world_applications_rating']) ? intval($_POST['real_world_applications_rating']) : 0;
$classroom_lively_rating = isset($_POST['classroom_lively_rating']) ? intval($_POST['classroom_lively_rating']) : 0;
$student_interaction_rating = isset($_POST['student_interaction_rating']) ? intval($_POST['student_interaction_rating']) : 0;
$content_delivery_experience_rating = isset($_POST['content_delivery_experience_rating']) ? intval($_POST['content_delivery_experience_rating']) : 0;

// Server-side validation
$errors = [];

if (empty($student_name)) {
    $errors[] = "Student name is required";
}

if (empty($faculty_name)) {
    $errors[] = "Faculty selection is required";
}

if (empty($subject_name)) {
    $errors[] = "Subject selection is required";
}

if (empty($topics_covered)) {
    $errors[] = "Topics covered is required";
}

if (empty($content_delivery_method)) {
    $errors[] = "Content delivery method is required";
}

// Check if there are any validation errors
if (!empty($errors)) {
    echo "Error: <br>";
    foreach ($errors as $error) {
        echo "- " . $error . "<br>";
    }
    echo "<br><a href='javascript:history.back()'>Go Back</a>";
    exit;
}

// Insert into database
$sql = "INSERT INTO faculty_feedback (
            faculty_name, 
            subject_name, 
            topics_covered, 
            content_delivery_method, 
            on_time_rating, 
            well_prepared_rating, 
            english_communication_rating, 
            explains_clearly_rating, 
            real_world_applications_rating, 
            classroom_lively_rating, 
            student_interaction_rating, 
            content_delivery_experience_rating
        ) VALUES (
            '$faculty_name', 
            '$subject_name', 
            '$topics_covered', 
            '$content_delivery_method', 
            $on_time_rating, 
            $well_prepared_rating, 
            $english_communication_rating, 
            $explains_clearly_rating, 
            $real_world_applications_rating, 
            $classroom_lively_rating, 
            $student_interaction_rating, 
            $content_delivery_experience_rating
        )";

if ($conn->query($sql) === TRUE) {
    echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Feedback Submitted</title>
            <link rel='stylesheet' href='styles.css'>
            <style>
                .success {
                    color: green;
                    margin: 30px 0;
                }
                .back-link {
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <h1>Velammal College Of Engineering & Technology</h1>
            <h2>Department of Information Technology</h2>
            
            <div class='success'>
                <h3>Thank you for your feedback!</h3>
                <p>Your evaluation for $faculty_name in the subject $subject_name has been submitted successfully.</p>
            </div>
            
            <div class='back-link'>
                <a href='index.html'>Submit another feedback</a>
            </div>
        </body>
        </html>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>