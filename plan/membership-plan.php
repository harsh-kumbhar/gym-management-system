<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<h2 style="text-align:center;">📋 Membership Plans</h2>

<!-- Internal CSS for Plan Cards -->
<style>
    .plans-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 30px;
        padding: 30px;
    }

    .plan-card {
        background-color: #2a2a2a;
        border: 1px solid #444;
        border-radius: 15px;
        padding: 30px 20px;
        width: 280px;
        text-align: center;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .plan-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.7);
    }

    .plan-card h3 {
        font-size: 2em;
        margin-bottom: 15px;
        color: #ffffff;
    }

    .plan-card p {
        font-size: 1.1em;
        color: #cccccc;
        margin: 8px 0;
    }
</style>

<div class="plans-container">

<?php
$sql = "SELECT * FROM MembershipPlan";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($plan = $result->fetch_assoc()) {
        echo "
        <div class='plan-card'>
            <h3>{$plan['PlanType']}</h3>
            <p><strong>Duration:</strong> {$plan['Duration']} months</p>
            <p><strong>Fees:</strong> ₹{$plan['Fees']}</p>
        </div>";
    }
} else {
    echo "<p style='text-align:center;'>No membership plans found.</p>";
}
?>

</div>

<?php include '../includes/footer.php'; ?>
