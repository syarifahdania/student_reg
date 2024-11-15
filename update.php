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
    <title>Edit Student Information</title>
    
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
    </style>
</head>
<body>
    <h2>Edit Information</h2>

    <?php
    include "db_conn.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
    }
    ?>

    <div class="form-container">
        <form action="update.php?id=<?php echo $row['id']; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" id="phone" name="phone" value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Program/Course:</label>
                <input type="text" id="program" name="program" value="<?php echo isset($row['program']) ? $row['program'] : ''; ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="dormitory" class="form-label">College Dormitory:</label>
                <input type="text" id="dormitory" name="dormitory" value="<?php echo isset($row['dormitory']) ? $row['dormitory'] : ''; ?>" class="form-control" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $program = $_POST['program'];
            $dormitory = $_POST['dormitory'];

            $sql = "UPDATE users SET name='$name', email='$email', phone='$phone', program='$program', dormitory='$dormitory' WHERE id=$id";

            if (mysqli_query($conn, $sql)) {
                echo "<p class='text-center text-success'>Record updated successfully</p>";
            } else {
                echo "<p class='text-center text-danger'>Error updating record: " . mysqli_error($conn) . "</p>";
            }
        }
        ?>

        <a href="view.php" class="btn btn-link">Click to view the list of students</a>
    </div>
</body>
</html>
