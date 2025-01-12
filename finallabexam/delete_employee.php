<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Employee ID is required.");
}

$employee_id = $_GET['id'];

$query = "DELETE FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);

if ($stmt->execute()) {
    header("Location: dashboard.php"); 
    exit;
} else {
    die("Error deleting employee: " . $conn->error);
}
