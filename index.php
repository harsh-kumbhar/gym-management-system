<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fit&Fine Management</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Modern, bold sans-serif font for a strong gym vibe -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Barlow Condensed', sans-serif;
            background-color: #1a1a1a;
            color: #f0f0f0;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
        }

        .hero-section {
            background-color: #d9d9d9;
            padding: 50px 20px;
            position: relative;
        }

        .hero-section img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }

        h1 {
            font-size: 3.5em;
            font-weight: 700;
            color: #ffffff;
            margin-top: 40px;
        }

        h4 {
            font-size: 1.3em;
            font-weight: 500;
            color: #cccccc;
            margin-bottom: 30px;
        }

        .login-btn {
            padding: 10px 20px;
            background-color: #333333;
            color: #ffffff;
            border: 1px solid #555;
            border-radius: 6px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #444444;
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <img src="..\Gym_Management_System\images\index_bg.jpg" alt="Gym Image">
    </div>

    <h1>Fit&Fine Management</h1>
    <h4>Your one-stop solution to manage gyms, members, staff, and more.</h4>
    <a href="../Gym_Management_System/admin/login.html" class="login-btn">Admin Login</a>

</body>
</html>
