<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];
    $result = $conn->query("SELECT * FROM Staff WHERE StaffID = $staff_id");
    $staff = $result->fetch_assoc();
}
?>

<?php include '../includes/header.php'; ?>

<h2 style="text-align:center;">✏️ Update Staff Details</h2>

<div style="display: flex; justify-content: center; margin-top: 30px;">
    <form action="update-staff.php" method="POST" style="background-color: #2a2a2a; padding: 30px; border-radius: 12px; width: 400px; color: #f0f0f0; box-shadow: 0 4px 8px rgba(0,0,0,0.3);">
        <input type="hidden" name="staff_id" value="<?php echo $staff['StaffID']; ?>">

        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo htmlspecialchars($staff['Name']); ?>" required style="width: 100%; padding: 8px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #555;"><br>

        <label>Phone Number:</label><br>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($staff['PhoneNumber']); ?>" required pattern="[0-9]{10}" title="Enter a valid 10-digit number" style="width: 100%; padding: 8px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #555;"><br>

        <label>Salary (₹):</label><br>
        <input type="number" name="salary" step="0.01" value="<?php echo $staff['Salary']; ?>" required style="width: 100%; padding: 8px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #555;"><br>

        <label>Gym:</label><br>
        <select name="gym_id" required style="width: 100%; padding: 8px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #555;">
            <?php
            $gyms = $conn->query("SELECT GymID, GymName FROM Gym");
            while ($row = $gyms->fetch_assoc()) {
                $selected = ($row['GymID'] == $staff['GymID']) ? 'selected' : '';
                echo "<option value='{$row['GymID']}' $selected>{$row['GymName']}</option>";
            }
            ?>
        </select><br>

        <input type="submit" name="update" value="Update Staff" style="width: 100%; padding: 10px; background-color: #4CAF50; border: none; border-radius: 5px; color: white; font-weight: bold; cursor: pointer;">
    </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = $_POST['staff_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $salary = $_POST['salary'];
    $gym_id = $_POST['gym_id'];

    $stmt = $conn->prepare("UPDATE Staff SET Name=?, PhoneNumber=?, Salary=?, GymID=? WHERE StaffID=?");
    $stmt->bind_param("ssdii", $name, $phone, $salary, $gym_id, $staff_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Staff updated successfully!'); window.location.href='manage-staff.php';</script>";
    } else {
        echo "<script>alert('❌ Update failed: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
$conn->close();
?>

<?php include '../includes/footer.php'; ?>
