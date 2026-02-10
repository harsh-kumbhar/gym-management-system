<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.html");
    exit();
}
include '../includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Gym Management System</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #1a1a1a;
            color: #f0f0f0;
            font-family: 'Barlow Condensed', sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 40px;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }

        nav a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 220px;
            height: 120px;
            background-color: #2c2c2c;
            color: #f0f0f0;
            text-decoration: none;
            font-size: 1.5rem;
            border-radius: 12px;
            box-shadow: 0px 0px 8px rgba(255, 255, 255, 0.1);
            transition: background-color 0.3s, transform 0.3s;
        }

        nav a:hover {
            background-color: #3a3a3a;
            transform: translateY(-5px);
        }
    </style>
</head>

<body>

    <h2>Welcome, <?php echo $_SESSION['admin_username']; ?> 👋</h2>

    <nav>
        <a href="../member/member-list.php">👤 Members</a>
        <a href="../equipment/manage-equipment.php">🏋️ Equipment</a>
        <a href="../staff/manage-staff.php">👨‍🔧 Staff</a>
        <a href="../member/view-fees.php">📄 View Fees</a>
        <a href="../payment/member-payments.php">💰 Payments</a>
        <a href="../plan/membership-plan.php">📋 Plans</a>
        <a href="../subscription/subscriptions.php">🔗 Subscriptions</a>
        <a href="../gym/gym-list.php">🏢 Gyms</a>
    </nav>

</body>
</html>

<?php include '../includes/footer.php'; ?>
