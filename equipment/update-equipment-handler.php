<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['equipment_id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $gym_id = $_POST['gym_id'];

    $stmt = $conn->prepare("UPDATE Equipment SET Name = ?, Type = ?, Status = ?, GymID = ? WHERE EquipmentID = ?");
    $stmt->bind_param("sssii", $name, $type, $status, $gym_id, $id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Equipment updated successfully!'); window.location.href='manage-equipment.php';</script>";
    } else {
        echo "<script>alert('❌ Update failed!'); window.history.back();</script>";
    }
}
?>
