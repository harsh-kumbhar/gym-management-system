<?php
include '../includes/db.php';
include '../includes/header.php';

// Fetch all staff with their gym names
$sql = "SELECT s.*, g.GymName 
        FROM Staff s
        LEFT JOIN Gym g ON s.GymID = g.GymID";
$result = $conn->query($sql);
?>

<h2 style="text-align:center;">👥 Staff List</h2>

<div style="text-align: right; margin: 20px;">
    <a href="add-staff.php" style="padding: 10px 15px; background-color: #333; color: white; text-decoration: none; border-radius: 8px;">➕ Add Staff</a>
</div>

<table style="width: 100%; border-collapse: collapse; background-color: #2a2a2a; color: #f0f0f0;">
    <thead>
        <tr style="background-color: #333;">
            <th style="padding: 12px; border-bottom: 1px solid #555;">Staff ID</th>
            <th style="padding: 12px; border-bottom: 1px solid #555;">Name</th>
            <th style="padding: 12px; border-bottom: 1px solid #555;">Phone Number</th>
            <th style="padding: 12px; border-bottom: 1px solid #555;">Salary (₹)</th>
            <th style="padding: 12px; border-bottom: 1px solid #555;">Gym</th>
            <th style="padding: 12px; border-bottom: 1px solid #555;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr style="text-align: center;">
            <td style="padding: 10px; border-bottom: 1px solid #555;"><?php echo 'STF' . str_pad($row['StaffID'], 3, '0', STR_PAD_LEFT); ?></td>
            <td style="padding: 10px; border-bottom: 1px solid #555;"><?php echo htmlspecialchars($row['Name']); ?></td>
            <td style="padding: 10px; border-bottom: 1px solid #555;"><?php echo htmlspecialchars($row['PhoneNumber']); ?></td>
            <td style="padding: 10px; border-bottom: 1px solid #555;">₹<?php echo number_format($row['Salary'], 2); ?></td>
            <td style="padding: 10px; border-bottom: 1px solid #555;"><?php echo htmlspecialchars($row['GymName']); ?></td>
            <td style="padding: 10px; border-bottom: 1px solid #555;">
                <a href="update-staff.php?id=<?php echo $row['StaffID']; ?>" style="margin-right: 10px; color: #4CAF50; font-size: 1.2em;">✏️</a>
                <a href="delete-staff.php?id=<?php echo $row['StaffID']; ?>" style="color: #E74C3C; font-size: 1.2em;" onclick="return confirm('Are you sure you want to delete this staff member?');">🗑️</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<?php include '../includes/footer.php'; ?>
