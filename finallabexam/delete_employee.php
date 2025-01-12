<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

// Get the employee ID from the query string
if (!isset($_GET['id'])) {
    die("Employee ID is required.");
}

$employee_id = $_GET['id'];

// Delete the employee from the database
$query = "DELETE FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);

if ($stmt->execute()) {
    header("Location: dashboard.php"); // Redirect to the dashboard after deletion
    exit;
} else {
    die("Error deleting employee: " . $conn->error);
}
