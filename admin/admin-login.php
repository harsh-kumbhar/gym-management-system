<?php
session_start();
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM Admin WHERE Username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Plaintext check (change this to hashed check if you hash passwords)
        if ($password === $row['Password']) {
            $_SESSION['admin_id'] = $row['AdminID'];
            $_SESSION['admin_username'] = $row['Username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('❌ Invalid password.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('❌ Admin not found.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
