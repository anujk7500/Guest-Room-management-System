<?php
include 'config.php';
include 'sidebar.php';
session_start();



$search_query = "";
    if (isset($_GET['id'])) {
        $search_query = $_GET['id'];
    

$users_query = "SELECT * FROM users where id=$search_query";
$result = mysqli_query($conn, $users_query);
$users_result = mysqli_fetch_assoc($result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $update_query = "UPDATE users SET name='$name', email='$email', password='$password' WHERE id=$search_query";
   
    mysqli_query($conn, $update_query);
    header("Location: manage_customers.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Hotel Booking</title>

    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin_booking.css">
    
    <style>
       
        .card {
            max-width: 600px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input{
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
}
.form-container {
    width: 600px;
    margin-top: 100px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: left;
}
        
    </style>
</head>
<body>
    
<!-- Main content area -->
<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Dashboard Overview</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

<div class="card">
    <h3 class="card-title text-center">Edit Room Details</h3>
    

    <form action="" method="POST" class="book_now" >
                            <div class="row">
                                <div class="col-md-12">
                                    <span>FullName</span>
                                    <input class="online_book" value="<?php echo $users_result['name']; ?>" type="text" name="name" required>
                                </div>
                                <div class="col-md-12">
                                    <span>email</span>
                                    <input class="online_book" value="<?php echo $users_result['email']; ?>" type="email" name="email" required>
                                </div>
                                <div class="col-md-12">
                                    <span>Password</span>
                                    <input class="online_book" placeholder="Enter Password" type="password" name="password" required>
                                </div>
                                
                                <div class="col-md-12">
                                    <button class="book_btn" type="submit">Save Changes</button>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-block">Cancel</a>
    </form>
</div>



</body>
</html>