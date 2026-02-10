<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<div class="container">
    <h2 style="text-align: center; margin-top: 20px;">📄 View Member Fees</h2>

    <!-- Search by ID -->
    <form method="GET" action="" style="margin-bottom: 20px; text-align: center;">
        <label for="member_id">Search by Member ID:</label><br>
        <input type="text" name="member_id" placeholder="e.g. 1 or PFS101" style="margin-top: 5px;">
        <input type="submit" value="Search">
    </form>

    <!-- Dropdown select -->
    <form method="GET" action="" style="margin-bottom: 30px; text-align: center;">
        <label for="member_id">Select Member:</label><br>
        <select name="member_id" required style="margin-top: 5px;">
            <option value="">-- Select Member --</option>
            <?php
            $members = $conn->query("SELECT MemberID, FName, LName FROM Member");
            while ($row = $members->fetch_assoc()) {
                $formattedID = "PFS" . str_pad($row['MemberID'], 3, "0", STR_PAD_LEFT);
                echo "<option value='" . $row['MemberID'] . "'>$formattedID - {$row['FName']} {$row['LName']}</option>";
            }
            ?>
        </select>
        <input type="submit" value="View Fees">
    </form>

    <?php
    if (isset($_GET['member_id']) && $_GET['member_id'] !== '') {
        $input = $_GET['member_id'];
        $memberID = intval(preg_replace('/\D/', '', $input)); // Remove non-numbers like PFS

        $query = "SELECT f.*, m.FName, m.LName
                  FROM FeesPaid f
                  JOIN Member m ON f.MemberID = m.MemberID
                  WHERE f.MemberID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $memberID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='fee-info' style='background-color: #2c2c2c; padding: 20px; border-radius: 15px; margin-top: 20px;'>";
            echo "<h3>✅ Fees Details for {$row['FName']} {$row['LName']} (PFS" . str_pad($row['MemberID'], 3, "0", STR_PAD_LEFT) . ")</h3>";
            echo "<ul style='list-style: none; padding-left: 0;'>";
            echo "<li><strong>Plan Duration:</strong> {$row['PlanDuration']}</li>";
            echo "<li><strong>Amount Paid:</strong> ₹{$row['Amount']}</li>";
            echo "<li><strong>Receipt No.:</strong> {$row['PaymentReceipt']}</li>";
            echo "</ul>";
            echo "</div>";
        } else {
            echo "<p style='color:red; text-align:center;'>❌ No payment record found for Member ID: $input</p>";
        }
        $stmt->close();
    }
    ?>
</div>

<?php include '../includes/footer.php'; ?>
