<?php
    session_start();
    if(!isset($_SESSION['status'])){
        header('Home Page'); 
    }
session_start();
session_destroy();
header("Login.html");
exit();
?>
<html>
<head>
    <title>Home</title>
</head>
<body>
        <h1>Welcome Home!</h1>
        <a href='logout.php'>logout </a>
</body>

   
</html>