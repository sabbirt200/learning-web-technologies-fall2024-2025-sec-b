<?php
include 'db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact_no = $_POST['contact_no'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    if (empty($name) || empty($contact_no) || empty($username) || empty($_POST['password'])) {
        $message = "All fields are required!";
    } else {
        $query = "INSERT INTO employees (name, contact_no, username, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $name, $contact_no, $username, $password);

        if ($stmt->execute()) {
            $message = "Employee registered successfully!";
            header("Location: index.php"); 
            exit;
        } else {
            $message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Register Employee</h2>
    
    <!-- Display any messages -->
    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="name">Employee Name:</label>
        <input type="text" id="name" name="name" placeholder="Full Name" required><br>

        <label for="contact_no">Contact Number:</label>
        <input type="text" id="contact_no" name="contact_no" placeholder="Contact Number" required><br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required><br>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="index.php">Login</a></p>
</body>
</html>
