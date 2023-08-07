<!DOCTYPE html>
<html lang="en">
<head>
    <title>Issue Book</title>
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
</head>
<body>
<body bgcolor="pink">
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
    <h2>Issue Book</h2>
    <form method="POST" action="issue_book.php">
        <label>Member ID:</label>
        <input type="text" name="member_id" required><br>

        <label>Book ID:</label>
        <input type="text" name="book_id" required><br>

        <button type="submit">Issue Book</button>
    </form>
    <center>
</body>
</html>




<?php
require_once 'php_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $member_id = $_POST['member_id'];
    $book_id = $_POST['book_id'];

    // Check if the book is available
    $sql = "SELECT * FROM books WHERE book_id = ? AND quantity > 0";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$book_id]);

    if ($stmt->rowCount() == 0) {
        echo "<br>Book is not available.";
    } else {
        // Insert a new transaction
        $issue_date = date('Y-m-d');
        $sql = "INSERT INTO transactions (book_id, member_id, issue_date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book_id, $member_id, $issue_date]);

        // Decrease the book quantity
        $sql = "UPDATE books SET quantity = quantity - 1 WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book_id]);

        echo "<br>Book issued successfully.";
    }
}
?>

