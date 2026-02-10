<?php
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $gym_id = $_POST['gym_id'];

    // Validate phone number uniqueness
    $check = $conn->prepare("SELECT StaffID FROM Staff WHERE PhoneNumber = ?");
    $check->bind_param("s", $phone);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('❌ This phone number is already used by another staff member!'); window.history.back();</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO Staff (Name, PhoneNumber, Salary, GymID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $name, $phone, $salary, $gym_id);

        if ($stmt->execute()) {
            echo "<script>alert('✅ Staff added successfully!'); window.location.href='manage-staff.php';</script>";
        } else {
            echo "<script>alert('❌ Error adding staff: " . $stmt->error . "'); window.history.back();</script>";
        }
        
        $stmt->close();
    }

    $check->close();
}

$conn->close();
?>
