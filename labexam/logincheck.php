<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users = file('users.txt', FILE_IGNORE_NEW_LINES);

    foreach ($users as $user) {
        list($stored_user, $stored_pass, $role, $name, $email) = explode('|', $user);
        if ($username == $stored_user && $password == $stored_pass) {
            $_SESSION['username'] = $stored_user;
            $_SESSION['role'] = $role;
            header("Location: " . ($role == 'admin' ? 'admin.php' : 'user.php'));
            exit;
        }
    }
    echo "Invalid username or password!";
}
?>