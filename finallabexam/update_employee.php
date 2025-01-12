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

// Fetch employee data from the database
$query = "SELECT * FROM employees WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$result = $stmt->get_result();
$employee = $result->fetch_assoc();

// Check if employee exists
if (!$employee) {
    die("Employee not found.");
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];

    // Validate the input
    if (empty($name) || empty($contact_no) || empty($username)) {
        $message = "All fields are required!";
    } else {
        // Update the employee in the database
        $updateQuery = "UPDATE employees SET name = ?, contact_no = ?, username = ? WHERE id = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sssi", $name, $contact_no, $username, $employee_id);

        if ($updateStmt->execute()) {
            $message = "Employee updated successfully!";
        } else {
            $message = "Error updating employee: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
    <h2>Update Employee</h2>

    <!-- Display message if there is any -->
    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($employee['contact_no']); ?>" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($employee['username']); ?>" required><br>

        <button type="submit">Update</button>
    </form>
    <a href="dashboard.php"><button>Back to Dashboard</button></a>

</body>
</html>
