<?php
include '../includes/db.php';
include '../includes/header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gym_id = $_POST['gym_id'];

    $sql = "INSERT INTO Member (FName, MName, LName, DOB, EmailID, PhoneNumber, Address, GymID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $fname, $mname, $lname, $dob, $email, $phone, $address, $gym_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Member added successfully!'); window.location.href='member-list.php';</script>";
    } else {
        echo "<script>alert('❌ Error adding member: " . $conn->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
