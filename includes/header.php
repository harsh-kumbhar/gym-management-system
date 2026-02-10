<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fit&Fine Management</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Barlow Condensed', sans-serif;
            margin: 0;
            background-color: #1a1a1a;
            color: #f0f0f0;
        }

        header h1 {
            text-align: center;
            margin: 20px 0;
            font-size: 2.8rem;
        }

        header h1 a {
            text-decoration: none;
            color: #f0f0f0;
            transition: color 0.3s;
        }

        header h1 a:hover {
            color: #bfbfbf;
        }

        .navbar {
            background-color: #2c2c2c;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 30px;
            flex-wrap: wrap;
            border-top: 1px solid #444;
            border-bottom: 1px solid #444;
        }

        .nav-links {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            flex-grow: 1;
            gap: 15px;
        }

        .nav-links a {
            padding: 10px 18px;
            text-decoration: none;
            color: #f0f0f0;
            font-weight: 600;
            font-size: 1.1rem;
            background-color: #3a3a3a;
            border-radius: 30px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .nav-links a:hover {
            background-color: #4d4d4d;
            transform: scale(1.05);
        }

        .logout-btn {
            margin-left: auto;
        }

        .logout-btn a {
            color: #ff4d4d;
            background-color: transparent;
            padding: 10px 18px;
            border: 1px solid #ff4d4d;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-btn a:hover {
            background-color: #ff4d4d;
            color: #1a1a1a;
        }

        hr {
            margin: 0;
            border: 0;
            height: 1px;
            background: #444;
        }
    </style>
</head>

<body>
    <header>
        <h1>
            <a href="../admin/dashboard.php">🏋️‍♂️ Fit&Fine Management</a>
        </h1>
    </header>

    <?php if (isset($_SESSION['admin_id'])): ?>
    <div class="navbar">
        <div class="nav-links">
            <a href="../member/member-list.php">👤 Members</a>
            <a href="../equipment/manage-equipment.php">🏋️ Equipment</a>
            <a href="../staff/manage-staff.php">👨‍🔧 Staff</a>
            <a href="../member/view-fees.php">📄 View Fees</a>
            <a href="../payment/member-payments.php">💰 Payments</a>
            <a href="../plan/membership-plan.php">📋 Plans</a>
            <a href="../subscription/subscriptions.php">🔗 Subscriptions</a>
            <a href="../gym/gym-list.php">🏢 Gyms</a>
        </div>
        <div class="logout-btn">
            <a href="../logout.php">🚪 Logout</a>
        </div>
    </div>
    <hr>
    <?php endif; ?>
