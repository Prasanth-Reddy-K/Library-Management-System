<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate the data (you can add more validation as per your requirements)
    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required.";
    } else {
        // Send the contact form data to your desired email address
        $to = "your_email@example.com";
        $subject = "Contact Form Submission";
        $headers = "From: $email\r\n" .
            "Reply-To: $email\r\n" .
            "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $success = "Oops! Something went wrong. Please try again later..";
        } else {
            $error = "Your message has been sent successfully";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contact Us</title>
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
    <h2>Contact Us</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } elseif (isset($success)) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>
    <form method="POST" action="contact.php">
        <label>Name:</label>
        <input type="text" name="name" required><br>

        <label>Email:</label>
        <input type="email" name="email" required><br>

        <label>Message:</label>
        <textarea name="message" required></textarea><br>

        <button type="submit">Send Message</button>
    </form>
    <footer> <p>terms & Conditions</p>
        <p>Terms and conditions of sale</p>
        <p>Privacy Policy</p>
        <p>Website terms and conditions</p>
    </footer>
</center>
</body>
</html>
