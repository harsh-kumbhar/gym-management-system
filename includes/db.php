<?php
$host = "localhost";
$user = "root";  // XAMPP default
$password = "";  // XAMPP default
$dbname = "GymManagement";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

/*Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
} else {
    echo "✅ Database connected successfully.";
}
*/

?>
