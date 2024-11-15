<?php

include "db_conn.php"; // Using database connection here

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
            alert('User Deleted Successfully');
            window.location.href = 'view.php';
        </script>";
    } else {
        echo "<script>
            alert('Error Deleting User');
            window.location.href = 'view.php';
        </script>";
    }
}
?>
