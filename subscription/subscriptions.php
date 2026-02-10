<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<h2 style="text-align:center;">📄 Active Subscriptions</h2>

<div style="display: flex; justify-content: center; margin-top: 20px;">
    <table cellpadding="10" cellspacing="0" style="width: 90%; background-color: #2a2a2a; color: #f0f0f0; border-collapse: collapse; border-radius: 10px; overflow: hidden;">
        <thead style="background-color: #444;">
            <tr>
                <th style="padding: 12px;">Subscription ID</th>
                <th>Member ID</th>
                <th>Member Name</th>
                <th>Plan ID</th>
                <th>Plan Type</th>
                <th>Duration (Months)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT 
                        s.SubscriptionID,
                        m.MemberID,
                        m.FName,
                        m.LName,
                        p.PlanID,
                        p.PlanType,
                        p.Duration
                    FROM Subscription s
                    JOIN Member m ON s.MemberID = m.MemberID
                    JOIN MembershipPlan p ON s.PlanID = p.PlanID";

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr style='text-align: center; border-bottom: 1px solid #555;'>
                            <td>SUB{$row['SubscriptionID']}</td>
                            <td>PFS{$row['MemberID']}</td>
                            <td>{$row['FName']} {$row['LName']}</td>
                            <td>PLAN{$row['PlanID']}</td>
                            <td>{$row['PlanType']}</td>
                            <td>{$row['Duration']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center; padding: 20px;'>No subscriptions found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
