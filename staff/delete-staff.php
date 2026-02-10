<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM Staff WHERE StaffID = ?");
    $stmt->bind_param("i", $staff_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Staff deleted successfully!'); window.location.href='manage-staff.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to delete staff: " . $stmt->error . "'); window.history.back();</script>";
    }
    $stmt->close();
}
$conn->close();
?>
