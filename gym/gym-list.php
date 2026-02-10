<?php
include '../includes/db.php';
include '../includes/header.php';
?>

<style>
    body {
        background-color: #1a1a1a;
        color: #f0f0f0;
        font-family: 'Barlow Condensed', sans-serif;
        margin: 0;
        padding: 20px;
    }
    h2 {
        text-align: center;
        margin-bottom: 30px;
        font-weight: bold;
    }
    .gym-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        padding: 0 20px;
    }
    .gym-card {
        background-color: #2c2c2c;
        padding: 15px;
        border: 1px solid #444;
        border-radius: 10px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .gym-card:hover {
        transform: scale(1.03);
        box-shadow: 0 0 10px #f0f0f0;
    }
    .gym-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
    }
    .gym-id {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .gym-name {
        font-size: 24px;
        margin-bottom: 10px;
    }
    .gym-info {
        font-size: 16px;
        margin-bottom: 5px;
    }
</style>

<h2>Registered Gyms</h2>

<div class="gym-container">
    <?php
    $sql = "SELECT * FROM Gym";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Just for now, let's assume image path is stored in DB (in future you can upload and save properly)
            $imagePath = !empty($row['ImagePath']) ? $row['ImagePath'] : 'assets/default-gym.jpg'; // Relative path

            echo "<div class='gym-card'>
                    <img src='$imagePath' alt='Gym Image' class='gym-image'>
                    <div class='gym-id'>GYM{$row['GymID']}</div>
                    <div class='gym-name'>{$row['GymName']}</div>
                    <div class='gym-info'><strong>Location:</strong> {$row['Location']}</div>
                    <div class='gym-info'><strong>Contact:</strong> {$row['ContactInfo']}</div>
                    <div class='gym-info'><strong>Admin:</strong> " . ($row['AdminID'] ? "ADMIN{$row['AdminID']}" : "—") . "</div>
                  </div>";
            
        }
    } else {
        echo "<p style='text-align:center;'>No gyms registered yet.</p>";
    }

    $conn->close();
    ?>
</div>

<?php include '../includes/footer.php'; ?>
