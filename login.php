<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'logindb';

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die('Could not connect to MySQL server: ' . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation if required)
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        $verifiedPasscode = password_verify($password, PASSWORD_DEFAULT);
        // Prepare and execute the SQL statement to fetch user data from the database
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$verifiedPasscode'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            // User found, login successful
            $success = 'Login successful!';
        } else {
            // User not found or incorrect credentials
            $error = 'Invalid email or password.';
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
</head>
<body>
    <h1>Login Page</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
