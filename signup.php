<?php
require_once "db.php";

// Sign Up
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation if required)
    if (empty($name) || empty($email) || empty($mobile) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        // Check if the email is already registered
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $error = 'Email already exists. Please choose a different email.';
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the user into the database
            $query = "INSERT INTO users (name, email, mobile, password) VALUES ('$name', '$email', '$mobile', '$hashedPassword')";
            if (mysqli_query($conn, $query)) {
                $success = 'Registration successful! Please log in.';
            } else {
                $error = 'Error: ' . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Signup & Login</title>
</head>
<body>
    <h1>Signup</h1>

    <?php if (isset($error) && isset($_POST['signup'])) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success) && isset($_POST['signup'])) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br><br>

        <label for="mobile">Mobile:</label><br>
        <input type="text" id="mobile" name="mobile"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" name="signup" value="Sign Up">
    </form>
    </body>
    </html>