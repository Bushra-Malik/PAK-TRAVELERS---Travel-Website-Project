<?php
session_start();

include("connection.php"); // Ensure this file contains your database connection details
// include("functions.php"); // You can include any additional functions here if needed

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    // Validate input (you may want to add more validation as per your requirements)
    if (!empty($user_name) && !empty($password)) {
        // Sanitize inputs to prevent SQL injection
        $user_name = mysqli_real_escape_string($con, $user_name);

        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database using prepared statement
        $query = "INSERT INTO users (user_name, password) VALUES (?, ?)";
        $stmt = mysqli_prepare($con, $query);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $user_name, $hashed_password);

        // Execute statement
        if (mysqli_stmt_execute($stmt)) {
            // Registration successful, redirect or show success message
            header("Location: login.php");
            exit;
        } else {
            // Error occurred during execution
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Please enter valid information.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PAK TRAVELERS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg">
    <section class="container-fuild">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3">
                <form class="form-container form-container-signup" method="post">
                    <h1 class="text-success" style="font-weight: 700;">Pak Travelers Sign Up</h1><br>
                    <div class="form-group">
                        <label for="user_name">Enter username</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Enter username" required>
                    </div><br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div><br>
                    <input type="submit" class="btn btn-success w-75" name="submit" value="Sign Up">
                    <a href="login.php" class="text-success">Click to Login</a><br><br>
                </form>
            </section>
        </section>
    </section>
</body>
</html>
