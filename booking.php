<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: index.php");
    exit();
}

include 'config.php';
include 'sidebaruser.php';
include 'headeruser.php';

$result = mysqli_query($conn, "SELECT * FROM rooms WHERE status = 'Available'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Rooms</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<body >
      

<hr>

<h1 style="font-size: 30px;padding: 0 0 0 70px;color:red;font-weight:bold;text-decoration:underline;">Hi,<?php echo $_SESSION['user_name']; ?></h1><h1> Welcome To Guest Room Management System </h1>
<hr>
<?php $user_id = $_SESSION['user_id']; ?>
    <div class="room-container">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
            <div class="room-card">
                <img src="uploads/<?php echo $row['room_image']; ?>" alt="Room Image">
                <h2><?php echo $row['room_name']; ?></h2>
                <p><?php echo $row['room_description']; ?></p>
                <p>Price: Rs<?php echo $row['room_price']; ?>/night</p>
                <a href="book.php?room_id=<?php echo $row['id']; ?>" class="book-btn">Book Now</a>
            </div>
        <?php endwhile; ?>
        

    </div>
    
</body>
</html>
<?php
    include 'footer.php';
?>