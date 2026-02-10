<?php
include '../includes/db.php';
include '../includes/header.php';

// Handle Search and Filter
$search = $_GET['search'] ?? '';
$filter_gym = $_GET['filter_gym'] ?? '';

// Prepare dynamic SQL
$sql = "SELECT e.*, g.GymName 
        FROM Equipment e 
        LEFT JOIN Gym g ON e.GymID = g.GymID 
        WHERE 1=1";

if (!empty($search)) {
    $search_term = '%' . $conn->real_escape_string($search) . '%';
    $sql .= " AND (e.Name LIKE '$search_term' OR e.Type LIKE '$search_term')";
}

if (!empty($filter_gym)) {
    $filter_gym = intval($filter_gym);
    $sql .= " AND e.GymID = $filter_gym";
}

// Execute Final Query
$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}
?>

<div class="container">
    <h2>🏋️ Equipment List</h2>

    <a href="add-equipment.php" style="float: right; margin-bottom: 10px;">➕ Add Equipment</a>

    <!-- Search & Filter Form -->
    <form method="GET" action="" style="margin-bottom: 20px;">
        <input type="text" name="search" placeholder="Search Equipment..." value="<?php echo htmlspecialchars($search); ?>">

        <select name="filter_gym">
            <option value="">-- Filter by Gym --</option>
            <?php
            $gyms = $conn->query("SELECT GymID, GymName FROM Gym");
            while ($row = $gyms->fetch_assoc()) {
                $selected = ($filter_gym == $row['GymID']) ? 'selected' : '';
                echo "<option value='" . $row['GymID'] . "' $selected>" . htmlspecialchars($row['GymName']) . "</option>";
            }
            ?>
        </select>

        <input type="submit" value="Apply">
        <a href="manage-equipment.php">Reset</a>
    </form>

    <!-- Equipment Table -->
    <table border="1" width="100%" cellspacing="0" cellpadding="8">
        <tr style="background-color: #f0f0f0; color: black;">
            <th>Equipment ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Status</th>
            <th>Gym</th>
            <th>Actions</th>
        </tr>

        <?php if ($result->num_rows > 0) { 
            while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo 'EQP' . str_pad($row['EquipmentID'], 3, '0', STR_PAD_LEFT); ?></td>
                <td><?php echo htmlspecialchars($row['Name']); ?></td>
                <td><?php echo htmlspecialchars($row['Type']); ?></td>
                <td><?php echo htmlspecialchars($row['Status']); ?></td>
                <td><?php echo htmlspecialchars($row['GymName']); ?></td>
                <td>
                    <a href="update-equipment.php?id=<?php echo $row['EquipmentID']; ?>">✏️</a>
                    <a href="delete-equipment.php?id=<?php echo $row['EquipmentID']; ?>" onclick="return confirm('Delete this equipment?')">🗑️</a>
                </td>
            </tr>
        <?php } 
        } else { ?>
            <tr>
                <td colspan="6" style="text-align:center;">❌ No Equipment Found.</td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
