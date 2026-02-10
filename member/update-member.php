<?php
include '../includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM Member WHERE MemberID = $id";
    $result = $conn->query($query);
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $gym_id = $_POST['gym_id'];

    $sql = "UPDATE Member SET FName=?, MName=?, LName=?, DOB=?, EmailID=?, PhoneNumber=?, Address=?, GymID=? 
            WHERE MemberID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssii", $fname, $mname, $lname, $dob, $email, $phone, $address, $gym_id, $id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Member updated successfully!'); window.location.href='member-list.php';</script>";
    } else {
        echo "<script>alert('❌ Update failed: " . $conn->error . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Member</title>
    <!-- 🖌️ Internal Styling -->
    <style>
        body {
            background-color: #1f1f1f;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #2c2c2c;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.7);
            width: 400px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="date"], input[type="number"], textarea {
            padding: 10px;
            border-radius: 10px;
            border: none;
            margin-bottom: 15px;
            background-color: #444;
            color: #fff;
            font-size: 1rem;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            padding: 12px;
            background-color: #4caf50;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #ffcc00;
            font-weight: bold;
        }

        .back-link:hover {
            color: #ffdb4d;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Update Member</h2>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $data['MemberID']; ?>">

        <label>First Name:</label>
        <input type="text" name="fname" value="<?php echo $data['FName']; ?>" required>

        <label>Middle Name:</label>
        <input type="text" name="mname" value="<?php echo $data['MName']; ?>">

        <label>Last Name:</label>
        <input type="text" name="lname" value="<?php echo $data['LName']; ?>" required>

        <label>DOB:</label>
        <input type="date" name="dob" value="<?php echo $data['DOB']; ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $data['EmailID']; ?>" required>

        <label>Phone:</label>
        <input type="text" name="phone" value="<?php echo $data['PhoneNumber']; ?>" required>

        <label>Address:</label>
        <textarea name="address" required><?php echo $data['Address']; ?></textarea>

        <label>Gym ID:</label>
        <input type="number" name="gym_id" value="<?php echo $data['GymID']; ?>" required>

        <input type="submit" value="Update Member">
    </form>

    <a href="member-list.php" class="back-link">⬅️ Back to Member List</a>
</div>

</body>
</html>
