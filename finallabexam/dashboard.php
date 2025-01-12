<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");  // Redirect to login if not logged in
    exit;
}

// Fetch employee data for display if search query exists
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch employees from the database based on search query
$query = "SELECT * FROM employees WHERE name LIKE ? OR username LIKE ?";
$stmt = $conn->prepare($query);
$searchTerm = "%$searchQuery%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$employees = [];
while ($row = $result->fetch_assoc()) {
    $employees[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Employee Management</h2>

   

    <!-- Search Form -->
    <form method="GET">
        <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search Employees" />
        <button type="submit">Search</button>
    </form>

    <h3>Employee List</h3>

    <!-- Display Employees -->
    <table border="1">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['username']); ?></td>
                    <td><?php echo htmlspecialchars($employee['contact_no']); ?></td>
                    <td>
                        <a href="update_employee.php?id=<?php echo $employee['id']; ?>">Update</a> |
                        <a href="delete_employee.php?id=<?php echo $employee['id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
     <!-- Logout Button -->
     <form action="logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>
</body>
</html>
