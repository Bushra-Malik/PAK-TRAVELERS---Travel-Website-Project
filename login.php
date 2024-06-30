<?php
session_start();

include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Read from database
        $query = "SELECT * FROM users WHERE user_name = ?";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $user_name);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                // Verify hashed password
                if (password_verify($password, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: home.html");
                    exit;
                } else {
                    echo "Wrong username or password!";
                }
            } else {
                echo "Wrong username or password!";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Database query failed!";
        }

    } else {
        echo "Please enter valid username and password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PAK TRAVELERS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg">
    <section class="container-fuild">
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-3">
                <form class="form-container" method="post">
                    <h1 class="text-success" style="font-weight: 700;">Pak Travelers Login</h1><br>
                    <div class="form-group">
                        <label for="user_name">Enter username</label>
                        <input type="text" class="form-control" name="user_name" placeholder="Enter username" required>
                    </div><br>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div><br>
                    <input type="submit" class="btn btn-success w-75" value="Login"></input>
                    <a href="signup.php" class="text-success">Click to Signup</a><br><br>
                </form>
            </section>
        </section>
    </section>
</body>
</html>
