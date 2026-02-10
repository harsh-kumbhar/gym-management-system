<?php 
include '../includes/db.php'; 

// Handle form submission
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $member_id = $_POST['member_id'];
    $plan_duration = $_POST['plan_duration'];
    $amount = $_POST['amount'];
    $receipt = $_POST['receipt'];

    // Corrected column name: PaymentReceipt
    $stmt = $conn->prepare("INSERT INTO FeesPaid (MemberID, PlanDuration, Amount, PaymentReceipt) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $member_id, $plan_duration, $amount, $receipt);

    if ($stmt->execute()) {
        header("Location: ../member/member-list.php");
        exit();
    } else {
        echo "Error adding payment: " . $stmt->error;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Payment</title>
    <style>
    body {
        background-color: #1a1a1a;
        color: #f0f0f0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-align: center;
    }
    input, select {
        background-color: #333;
        color: #f0f0f0;
        padding: 10px;
        margin: 8px;
        border: none;
        border-radius: 5px;
        width: 300px;
    }
    input[type="submit"] {
        background-color: #444;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #666;
    }
</style>

</head>
<body>
<h2>Add Member Payment</h2>

<input type="text" id="memberSearch" onkeyup="filterMembers()" placeholder="Search Member by Name or ID...">

<form action="add-payment.php" method="POST">
    <label>Member:</label>
    <select name="member_id" id="memberDropdown" required>
        <option value="">-- Select Member --</option>
        <?php
        $result = $conn->query("SELECT m.MemberID, m.FName, m.LName 
                                FROM Member m 
                                LEFT JOIN FeesPaid f ON m.MemberID = f.MemberID 
                                WHERE f.MemberID IS NULL");

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $formattedID = "PFS" . str_pad($row['MemberID'], 3, '0', STR_PAD_LEFT);
                $fullName = htmlspecialchars($row['FName'] . " " . $row['LName']);
                echo "<option value='{$row['MemberID']}'>{$formattedID} - {$fullName}</option>";
            }
        } else {
            echo "<option value=''>All members have paid</option>";
        }
        ?>
    </select><br><br>

    <label>Plan Duration:</label>
    <select name="plan_duration" required>
        <option value="3 Months">3 Months</option>
        <option value="6 Months">6 Months</option>
        <option value="12 Months">12 Months</option>
    </select><br><br>

    <label>Amount (₹):</label>
    <select name="amount" required>
        <option value="">-- Select Amount --</option>
        <option value="2500">2500</option>
        <option value="5000">5000</option>
        <option value="9000">9000</option>
    </select><br><br>

    <label>Payment Receipt:</label>
    <input type="text" name="receipt" value="<?php echo 'RCPT' . rand(1000,9999); ?>" readonly required><br><br>

    <input type="submit" value="Add Payment">
</form>

<script>
function filterMembers() {
    const input = document.getElementById("memberSearch").value.toUpperCase();
    const dropdown = document.getElementById("memberDropdown");
    const options = dropdown.getElementsByTagName("option");

    for (let i = 1; i < options.length; i++) {
        const txt = options[i].text.toUpperCase();
        options[i].style.display = txt.includes(input) ? "" : "none";
    }
}
</script>

</body>
</html>
