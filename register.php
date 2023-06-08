<?php
require_once "db.php";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate form data (you can add more validation if required)
    if (empty($name) || empty($email) || empty($password)) {
        $error = 'Please fill in all the fields.';
    } else {
        // Prepare and execute the SQL statement to insert the data into the database
        $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $query)) {
            $success = 'Registration successful!';
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Page</title>
</head>
<body>
<style>
        body{
            background-image:url(images/blue.jpg);
            background-repeat:no-repeat;
            background-size: cover;
        }
    </style>
    <h1>Registration Page</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <?php if (isset($success)) { ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
