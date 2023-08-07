<?php
require_once 'php_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search_term = $_POST['search_term'];

    // Search for books matching the search term
    $sql = "SELECT * FROM books WHERE title LIKE ? OR author LIKE ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["%$search_term%", "%$search_term%"]);

    if ($stmt->rowCount() == 0) {
        echo "No books found.";
    } else {
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <h2>Search Results</h2>
        <table>
            <tr>
                <th>Book ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Quantity</th>
            </tr>
            <?php foreach ($books as $book) { ?>
                <tr>
                    <td><?php echo "{$book['book_id']}   "; ?></td>
                    <td><?php echo "{$book['title']}   "; ?></td>
                    <td><?php echo "{$book['author']}   "; ?></td>
                    <td><?php echo "{$book['quantity']}   "; ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Search Book</title>
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
    <h2>Search Book</h2>
    <form method="POST" action="search_book.php">
        <label>Search Term:</label>
        <input type="text" name="search_term" required><br>

        <button type="submit">Search</button>
    </form>
</center>
</body>
</html>
