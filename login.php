<?php
include 'config.php';
session_start();
$error_message = '';

// Default admin credentials
$default_admin_email = "admin@gr.com";
$default_admin_password = "admin@123";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check for default admin credentials
    if ($email === $default_admin_email && $password === $default_admin_password) {
        // Set session variables for admin
        $_SESSION['user_name'] = 'Admin';
        $_SESSION['user_role'] = 'admin';

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    }

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables for logged-in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Redirect to the booking page
        header("Location: booking.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
}
?>


