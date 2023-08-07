<?php
session_start();
require_once 'php_connect.php';

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if the username is already taken
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    if ($stmt->rowCount() > 0) {
        $error = "Username already taken. Please choose a different username.";
    } else {
        // Insert the new user record into the database
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username, $password]);

        $_SESSION['user_id'] = $conn->lastInsertId();
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sign Up</title>
 <meta charset="utf-8">
 <meta name="viewport"
 content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
 <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
 </script>
 <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
 </script>
    <style>
    html {
 background-image:url("https://th.bing.com/th?id=OIP.eBstEy_IK21eUJzFcf5BKwHaE7&w=306&h=204&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2");

    }
    </style>
</head>
<body >
<nav class="navbar navbar-inverse">
        <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand">Library</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="file1.html">Home</a></li>
        <li><a href="operations.html">Options</a></li>
        <li><a href="about.html">About Library</a></li>
        <li><a href="contact.html">Contact Us</a></li>
       
        </ul>
        </div>
        </nav>
    <center>
    <h2>Sign Up</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="signup.php">
        <label color= "white">Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Sign Up</button>
    </form>
    </center>
</body>
</html>
