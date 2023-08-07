<?php
require_once 'php_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transaction_id = $_POST['transaction_id'];

    // Check if the transaction exists
    $sql = "SELECT * FROM transactions WHERE transaction_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$transaction_id]);

    if ($stmt->rowCount() == 0) {
        echo "Invalid transaction ID.";
    } else {
        $transaction = $stmt->fetch(PDO::FETCH_ASSOC);
        $book_id = $transaction['book_id'];

        // Update the transaction with the return date
        $return_date = date('Y-m-d');
        $sql = "UPDATE transactions SET return_date = ? WHERE transaction_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$return_date, $transaction_id]);

        // Increase the book quantity
        $sql = "UPDATE books SET quantity = quantity + 1 WHERE book_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$book_id]);

        echo "Book returned successfully.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Return Book</title>
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
    <h2>Return Book</h2>
    <form method="POST" action="return_book.php">
        <label>Transaction ID:</label>
        <input type="text" name="transaction_id" required><br>

        <button type="submit">Return Book</button>
    </form>
</center>
</body>
</html>
