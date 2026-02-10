<?php
include '../includes/db.php';
include '../includes/header.php';

// Handle search if submitted
$search_id = isset($_GET['search']) ? intval($_GET['search']) : 0;

if ($search_id > 0) {
    $sql = "SELECT f.*, m.FName, m.MName, m.LName 
            FROM FeesPaid f 
            INNER JOIN Member m ON f.MemberID = m.MemberID 
            WHERE m.MemberID = $search_id";
} else {
    $sql = "SELECT f.*, m.FName, m.MName, m.LName 
            FROM FeesPaid f 
            INNER JOIN Member m ON f.MemberID = m.MemberID";
}

$result = $conn->query($sql);
?>

<!-- Internal CSS -->
<style>
    body {
        margin: 0;
        font-family: 'Barlow Condensed', sans-serif;
        background-color: #1a1a1a;
        color: #f0f0f0;
        padding: 20px;
    }

    h2 {
        text-align: center;
        font-size: 2.5em;
        margin-bottom: 20px;
        color: #ffffff;
    }

    form {
        text-align: center;
        margin-bottom: 30px;
    }

    input[type="number"],
    input[type="submit"],
    a {
        padding: 10px 15px;
        margin: 5px;
        border-radius: 5px;
        border: none;
        font-size: 16px;
        font-family: 'Barlow Condensed', sans-serif;
    }

    input[type="number"] {
        background-color: #333333;
        color: #f0f0f0;
        border: 1px solid #555;
    }

    input[type="submit"] {
        background-color: #555555;
        color: #ffffff;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #777777;
    }

    a {
        background-color: #444444;
        color: #ffffff;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    a:hover {
        background-color: #666666;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        padding: 12px;
        border: 1px solid #555;
        text-align: center;
    }

    th {
        background-color: #333333;
        color: #ffffff;
    }

    tr:nth-child(even) {
        background-color: #2a2a2a;
    }

    tr:nth-child(odd) {
        background-color: #1f1f1f;
    }

    td {
        color: #dddddd;
    }
</style>

<!-- Page Content -->
<h2>💳 All Member Payments</h2>

<form method="GET" action="">
    <input type="number" name="search" placeholder="Search by Member ID" required>
    <input type="submit" value="Search">
    <a href="member-payments.php">Reset</a>
</form>

<table>
    <tr>
        <th>Member ID</th>
        <th>Name</th>
        <th>Plan Duration</th>
        <th>Amount Paid (₹)</th>
        <th>Receipt</th>
    </tr>

    <?php if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo 'PFS' . str_pad($row['MemberID'], 3, '0', STR_PAD_LEFT); ?></td>
                <td><?php echo $row['FName'] . ' ' . $row['MName'] . ' ' . $row['LName']; ?></td>
                <td><?php echo $row['PlanDuration']; ?></td>
                <td>₹<?php echo $row['Amount']; ?></td>
                <td><?php echo $row['PaymentReceipt']; ?></td>
            </tr>
    <?php }
    } else {
        echo "<tr><td colspan='5'>No payment records found.</td></tr>";
    } ?>
</table>

<?php include '../includes/footer.php'; ?>
