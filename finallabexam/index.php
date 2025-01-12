<?php
// Include database connection
include 'db.php';

session_start(); // Start the session

$message = ''; // For showing error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        $message = "All fields are required!";
    } else {
        // Fetch user data from the database
        $query = "SELECT * FROM employees WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Save user data in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['name'] = $user['name'];

                // Redirect to dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                $message = "Invalid username or password!";
            }
        } else {
            $message = "User not found!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Display error message -->
    <?php if (!empty($message)) : ?>
        <p style="color: red;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Password" required><br>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>
