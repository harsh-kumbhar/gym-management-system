<?php
include '../includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $conn->prepare("DELETE FROM Equipment WHERE EquipmentID = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>alert('✅ Equipment deleted!'); window.location.href='manage-equipment.php';</script>";
    } else {
        echo "<script>alert('❌ Deletion failed!'); window.history.back();</script>";
    }
}
?>
