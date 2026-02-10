<?php
include '../includes/db.php';
include '../includes/header.php';

// Handle search if submitted
$search_id = isset($_GET['search']) ? intval($_GET['search']) : 0;

if ($search_id > 0) {
    $sql = "SELECT m.*, f.Amount, f.PlanDuration 
            FROM Member m 
            LEFT JOIN FeesPaid f ON m.MemberID = f.MemberID 
            WHERE m.MemberID = $search_id";
} else {
    $sql = "SELECT m.*, f.Amount, f.PlanDuration 
            FROM Member m 
            LEFT JOIN FeesPaid f ON m.MemberID = f.MemberID";
}
$result = $conn->query($sql);
?>

<style>
    h2 {
        text-align: center;
        margin-top: 20px;
        font-size: 2rem;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        margin: 20px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .top-bar a {
        text-decoration: none;
        padding: 10px 18px;
        background-color: #3a3a3a;
        color: #f0f0f0;
        border-radius: 30px;
        transition: background-color 0.3s;
        font-weight: bold;
    }

    .top-bar a:hover {
        background-color: #4d4d4d;
    }

    form {
        text-align: center;
        margin: 20px 0;
    }

    input[type="number"], input[type="submit"] {
        padding: 10px;
        border-radius: 10px;
        border: none;
        margin: 5px;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 1rem;
    }

    input[type="number"] {
        width: 250px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: white;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    a.reset-link {
        display: inline-block;
        margin-top: 10px;
        text-decoration: none;
        color: #ffcc00;
        font-weight: bold;
    }

    a.reset-link:hover {
        color: #ffdb4d;
    }

    table {
        width: 95%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #2c2c2c;
        border: 1px solid #444;
    }

    th, td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #444;
        color: #f0f0f0;
    }

    th {
        background-color: #3a3a3a;
        font-size: 1.1rem;
    }

    tr:hover {
        background-color: #444;
    }

    td a {
        margin: 0 5px;
        text-decoration: none;
        font-size: 1.2rem;
    }

    td a:hover {
        opacity: 0.8;
    }
</style>

<!-- 🎯 Content Starts Here -->
<div class="top-bar">
    <a href="../payment/add-payment.php">💳 Add Payment</a>
    <a href="add-member.html">➕ Add New Member</a>
</div>

<h2>Members List</h2>

<form method="GET" action="">
    <input type="number" name="search" placeholder="Search by Member ID" required>
    <input type="submit" value="Search">
    <br>
    <a class="reset-link" href="member-list.php">🔄 Reset</a>
</form>

<table>
    <tr>
        <th>Serial No.</th>
        <th>Member ID</th>
        <th>Name</th>
        <th>DOB</th>
        <th>Age</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Gym</th>
        <th>Payment</th>
        <th>Actions</th>
    </tr>

    <?php 
    $sn = 1;
    while ($row = $result->fetch_assoc()) { 
        $dob = new DateTime($row['DOB']);
        $today = new DateTime();
        $age = $today->diff($dob)->y;
    ?>
    <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo 'PFS' . str_pad($row['MemberID'], 3, '0', STR_PAD_LEFT); ?></td>
        <td><?php echo $row['FName'] . " " . $row['MName'] . " " . $row['LName']; ?></td>
        <td><?php echo $row['DOB']; ?></td>
        <td><?php echo $age; ?></td>
        <td><?php echo $row['EmailID']; ?></td>
        <td><?php echo $row['PhoneNumber']; ?></td>
        <td><?php echo $row['Address']; ?></td>
        <td><?php echo $row['GymID']; ?></td>
        <td>
            <?php
            echo $row['Amount'] ? "₹" . $row['Amount'] . " (" . $row['PlanDuration'] . ")" : "<span style='color:red;'>Not Paid</span>";
            ?>
        </td>
        <td>
            <a href="update-member.php?id=<?php echo $row['MemberID']; ?>">✏️</a>
            <a href="delete-member.php?id=<?php echo $row['MemberID']; ?>" onclick="return confirm('Are you sure you want to delete this member?')">🗑️</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php include '../includes/footer.php'; ?>
