<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Staff</title>

    <!-- Internal CSS for Dark Form Styling -->
    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Barlow Condensed', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        h2 {
            font-size: 2.5em;
            margin-bottom: 30px;
            text-align: center;
        }

        form {
            background-color: #2a2a2a;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.6);
            width: 100%;
            max-width: 500px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: 600;
            color: #cccccc;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #555;
            border-radius: 6px;
            background-color: #333;
            color: #f0f0f0;
            font-size: 1em;
        }

        input[type="submit"] {
            background-color: #333;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #444;
        }
    </style>

</head>
<body>

    <h2>➕ Add New Staff</h2>

    <form action="add-staff-logic.php" method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" required pattern="[0-9]{10}" title="Enter a 10-digit phone number">

        <label for="salary">Salary (₹):</label>
        <input type="number" name="salary" id="salary" step="0.01" required>

        <label for="gym_id">Gym:</label>
        <select name="gym_id" id="gym_id" required>
            <option value="">-- Select Gym --</option>
            <?php
            include '../includes/db.php';
            $gyms = $conn->query("SELECT GymID, GymName FROM Gym");
            while ($row = $gyms->fetch_assoc()) {
                echo "<option value='" . $row['GymID'] . "'>" . $row['GymName'] . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Add Staff">
    </form>

</body>
</html>
