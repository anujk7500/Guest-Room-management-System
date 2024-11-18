<?php
session_start();
include 'config.php';
include 'sidebaruser.php';
include 'headeruser.php';

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];


$bookings_query = "
    SELECT b.id, r.room_name, b.check_in_date, b.check_out_date, b.total_price, u.name
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    JOIN users u ON b.user_id = u.id
    WHERE b.user_id= '$user_id'
    ORDER BY b.check_in_date DESC";
    
$bookings_result = mysqli_query($conn, $bookings_query);


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Hotel Booking</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin_booking.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>


<!-- Main content area -->
<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Your Latest Booking</h1>
        <div class="user-info">
            <span class="username"><?php echo $_SESSION['user_name']; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

   

    <!-- To show recent 7 booking orders -->

    
        <table class="booking-table">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Booking ID</th>
                    <th>Room Name</th>
                    <th>User Name</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count=1;
                 while ($booking = mysqli_fetch_assoc($bookings_result)): ?>
                    <tr>
                        <td><?php echo $count++; ?></td>
                        <td><?php echo $booking['id']; ?></td>
                        <td><?php echo $booking['room_name']; ?></td>
                        <td><?php echo $booking['name']; ?></td>
                        <td><?php echo $booking['check_in_date']; ?></td>
                        <td><?php echo $booking['check_out_date']; ?></td>
                        <td>₹ <?php echo $booking['total_price']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?php echo $booking['id']; ?>" class="btn-edit">Edit</a>
                            <a href="delete_booking.php?id=<?php echo $booking['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </section>

</div>


</body>
</html>
