<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(248, 200, 220);
        }
        .signin-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Student System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="list_students.php">List Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_student.php">Add Student</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sign In Form -->
    <div class="signin-container">
        <h2 class="text-center">Sign In</h2>
        <form action="signin.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        <div class="text-center mt-3">
            <a href="login.php">Already have an account? Login here</a>
        </div>
    </div>

    <?php
    include "db_conn.php"; // Using database connection file here

    if ($_SERVER["REQUEST_METHOD"] == "POST") { // Checks if form has been submitted
        $username = mysqli_real_escape_string($conn, $_POST['username']); // Get the username value
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Get the password value from the form

        // Check if the username already exists
        $checkUser = "SELECT COUNT(*) FROM users_reg WHERE username = '$username'";
        $result = mysqli_query($conn, $checkUser);
        $row = mysqli_fetch_array($result);

        if ($row[0] > 0) {
            echo "<div class='alert alert-danger mt-3 text-center'>Error: Username already exists. Please choose a different one.</div>";
        } else {
            // Insert the new user if the username is unique
            $sql = "INSERT INTO users_reg (username, password) VALUES ('$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                echo "<div class='alert alert-success mt-3 text-center'>New record created successfully</div>";
            } else {
                echo "<div class='alert alert-danger mt-3 text-center'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</div>";
            }
        }
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
