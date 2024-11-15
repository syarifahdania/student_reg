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
    <title>STUDENT REGISTRATION FORM</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: powderblue;
        }
        h2 {
            color: black;
            text-align: center;
            margin-top: 20px;
        }
        img {
            width: 80%;
            height: auto;
            display: block;
            margin: 20px auto;
        }
        .table-container {
            width: 95%;
            margin: 30px auto;
        }
        .welcome-msg {
            text-align: center;
            margin-top: 20px;
        }
        .info-text {
            text-align: center;
            margin: 20px auto;
            max-width: 800px;
        }
        .form-link {
            text-align: center;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <h2>STUDENT REGISTRATION FORM</h2>
    <img src="welcome.png" alt="welcoming image">
    <div class="welcome-msg">
        <h3>Welcome, <?php echo $_SESSION['username']; ?> </h3>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
    </div>

    <p class="info-text">
        We’re excited to have you join our academic community! Please take a few moments to complete your registration.
        This form will collect essential information about you, including contact details, chosen program, and accommodations.
        Your details will help us ensure that you have the resources and support you need throughout your studies.
    </p>

    <div class="table-container">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Program/Course</th>
                    <th>College Dormitory</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "db_conn.php";

                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . (isset($row["id"]) ? $row["id"] : "") . "</td>";
                        echo "<td>" . (isset($row["name"]) ? $row["name"] : "") . "</td>";
                        echo "<td>" . (isset($row["email"]) ? $row["email"] : "") . "</td>";
                        echo "<td>" . (isset($row["phone"]) ? $row["phone"] : "") . "</td>";
                        echo "<td>" . (isset($row["program"]) ? $row["program"] : "") . "</td>";
                        echo "<td>" . (isset($row["dormitory"]) ? $row["dormitory"] : "") . "</td>";
                        echo "<td><a href='update.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a></td>";
                        echo "<td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No Data Found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="form-link">
        <a href="register.php" class="btn btn-success">Click to fill in registration form</a>
    </div>
</body>
</html>
