<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(248, 200, 220);
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .error-message {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

    <!-- Login Form -->
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="signin.php">Don't have an account? Register here</a>
        </div>

        <?php
        session_start(); // Starting session
        include "db_conn.php"; // Using database connection file here

        if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
            $username = mysqli_real_escape_string($conn, $_POST['username']); // Get the username value
            $password = $_POST['password']; // Get the password value from the form

            $sql = "SELECT * FROM users_reg WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) { // Check if user exists
                $row = mysqli_fetch_assoc($result); // Gets the data from the database
                if (password_verify($password, $row['password'])) { // Checks if the password matches
                    $_SESSION['username'] = $username; // Set the session variable
                    header("Location: view.php");
                    exit; // Prevent further script execution after redirection
                } else {
                    echo "<p class='error-message'>Invalid username or password</p>"; // Display an error message
                }
            } else {
                echo "<p class='error-message'>No user found with that username</p>";
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
