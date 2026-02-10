<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $status = $_POST['status'];
    $gym_id = $_POST['gym_id'];

    $sql = "INSERT INTO Equipment (Name, Type, Status, GymID)
            VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $type, $status, $gym_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Equipment added successfully!'); window.location.href='manage-equipment.php';</script>";
    } else {
        echo "<script>alert('❌ Failed to add equipment: " . $stmt->error . "'); window.history.back();</script>";
    }

    $stmt->close();
}
$conn->close();
?>
