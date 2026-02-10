<?php
include '../includes/db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Equipment</title>
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
        input, select, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        input[type="submit"] {
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>➕ Add New Equipment</h2>

    <form action="add-equipment-handler.php" method="POST">
        <label>Equipment Name:</label>
        <input type="text" name="name" required>

        <label>Type:</label>
        <input type="text" name="type" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="Available">Available</option>
            <option value="In Use">In Use</option>
            <option value="Under Maintenance">Under Maintenance</option>
        </select>

        <label>Gym:</label>
        <select name="gym_id" required>
            <option value="">-- Select Gym --</option>
            <?php
            $gyms = $conn->query("SELECT GymID, GymName FROM Gym");
            if ($gyms && $gyms->num_rows > 0) {
                while ($row = $gyms->fetch_assoc()) {
                    echo "<option value='" . $row['GymID'] . "'>" . htmlspecialchars($row['GymName']) . "</option>";
                }
            } else {
                echo "<option value=''>No Gyms Found</option>";
            }
            ?>
        </select>

        <input type="submit" value="Add Equipment">
    </form>
</body>
</html>
