<?php
require_once "db.php";

// Login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation if required)
    if (empty($email) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        // Check if the email exists in the database
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the user record
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, log in the user
                // You can add your login logic here, such as setting session variables or redirecting to a dashboard page
                $success = 'Login successful!';
            } else {
                $error = 'Invalid email or password.';
            }
        } else {
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
    <?php if (isset($error)) : ?>
        <div><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (isset($success)) : ?>
        <div><?php echo $success; ?></div>
    <?php endif; ?>

    <h1>Login</h1>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="passwordForm" id="password" required><br><br>
        <input type="submit" name="login" value="Login">
    </form>
    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
</body>
</html>
