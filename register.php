<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: powderblue;
        }
        h2 {
            color: black;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container a {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 95%;
            margin: 50px auto;
            border-collapse: collapse;
            border-radius: 25px;
            border: 1px solid black;
        }
        td {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h2>Fill in the form to add a new student</h2>
    <div class="form-container">
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program/Course:</label>
                <input type="text" id="program" name="program" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dormitory" class="form-label">College Dormitory:</label>
                <input type="text" id="dormitory" name="dormitory" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Add Student</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "db_conn.php";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $program = $_POST['program'];
            $dormitory = $_POST['dormitory'];

            $sql = "INSERT INTO users (name, email, phone, program, dormitory) VALUES ('$name', '$email', '$phone', '$program', '$dormitory')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>
                    alert('New student added successfully!');
                    window.location.href = 'view.php';
                </script>";
            } else {
                echo "<script>
                    alert('Error adding student: " . mysqli_error($conn) . "');
                    window.location.href = 'register.php';
                </script>";
            }
        }
        ?>

        <a href="view.php" class="btn btn-link">Click to view the list of students</a>
    </div>
</body>
</html>
