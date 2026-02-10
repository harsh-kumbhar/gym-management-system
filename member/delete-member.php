<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM Member WHERE MemberID = $id";

    if ($conn->query($sql)) {
        echo "<script>alert('🗑️ Member deleted successfully!'); window.location.href='member-list.php';</script>";
    } else {
        echo "<script>alert('❌ Error deleting member: " . $conn->error . "'); window.history.back();</script>";
    }
}
$conn->close();
?>
