<?php
include '../includes/db.php';

$equipment_id = $_GET['id'] ?? null;

if ($equipment_id) {
    $stmt = $conn->prepare("SELECT * FROM Equipment WHERE EquipmentID = ?");
    $stmt->bind_param("i", $equipment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $equipment = $result->fetch_assoc();
} else {
    die("❌ No equipment ID provided.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Equipment</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 40px;
        }
        form {
            max-width: 500px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: #2196F3;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #0b7dda;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>✏️ Update Equipment Details</h2>

    <form method="POST" action="update-equipment-handler.php">
        <input type="hidden" name="equipment_id" value="<?php echo htmlspecialchars($equipment['EquipmentID']); ?>">

        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($equipment['Name']); ?>" required>

        <label>Type:</label>
        <input type="text" name="type" value="<?php echo htmlspecialchars($equipment['Type']); ?>" required>

        <label>Status:</label>
        <select name="status" required>
            <?php
            $statuses = ['Available', 'In Use', 'Under Maintenance'];
            foreach ($statuses as $status) {
                $selected = ($equipment['Status'] == $status) ? 'selected' : '';
                echo "<option value='$status' $selected>$status</option>";
            }
            ?>
        </select>

        <label>Gym:</label>
        <select name="gym_id" required>
            <?php
            $gyms = $conn->query("SELECT GymID, GymName FROM Gym");
            while ($row = $gyms->fetch_assoc()) {
                $selected = ($row['GymID'] == $equipment['GymID']) ? 'selected' : '';
                echo "<option value='" . htmlspecialchars($row['GymID']) . "' $selected>" . htmlspecialchars($row['GymName']) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Update Equipment">
    </form>
</body>
</html>
