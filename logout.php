<?php
session_start();
session_unset();  // Clear all session variables
session_destroy(); // Destroy the session

// Redirect to login page
header("Location: ../Gym_Management_System/admin/login.html");
exit();
