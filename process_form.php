<?php
// process_form.php

// Include the database configuration file
require_once 'config.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $date = htmlspecialchars(trim($_POST['date']));
    $dropdown = htmlspecialchars(trim($_POST['dropdown']));
    $number = htmlspecialchars(trim($_POST['number']));
    $email = htmlspecialchars(trim($_POST['email']));
    $address = htmlspecialchars(trim($_POST['address']));

    // Basic validation to check if fields are not empty
    if (empty($name) || empty($date) || empty($dropdown) || empty($number) || empty($email) || empty($address)) {
        echo "All fields are required.";
        exit;
    }

    // Establish a connection to the MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare an SQL statement to insert the form data
    $stmt = $conn->prepare("INSERT INTO form_submissions (name, submission_date, selected_option, number_field, email, address) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("sssiss", $name, $date, $dropdown, $number, $email, $address);

    // Execute the statement and provide feedback
    if ($stmt->execute()) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
