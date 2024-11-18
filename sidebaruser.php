<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">    
    <link rel="stylesheet" href="sidebar.css">
</head>

<body>

<!-- Sidebar with navigation and logout -->
<div class="sidebar">
    <h2>User Dashboard</h2>
    <a href="booking.php">Available Rooms</a>
    
    <a href="#">Near Place to Visit</a>
    <?php $user_id = $_SESSION['user_id']; ?>
    <a href="latest_booking.php?id=<?php echo $user_id; ?>">Latest Bookings</a> 
    
    <a href="logout.php" class="logout"> Logout</a>
</div>

</body>
</html>