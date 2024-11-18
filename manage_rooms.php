<?php
include 'config.php';
include 'sidebar.php';

session_start();

// Fetch user data
$query = "SELECT * FROM rooms ORDER BY id DESC";
$result = mysqli_query($conn, $query);

//To fetch username on left corner
$username = $_SESSION['user_name'];

// For search query

$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
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
    <link rel="stylesheet" href="manage_rooms.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>



<!-- Main content area -->
<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Manage Rooms</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

    <section id="recent-bookings">
        <div class="search-container">
            
            <form action="manage_rooms.php#recent-bookings" method="GET" class="form-inline my-3">
                <input type="text" name="search" placeholder="Search by room name..." class="form-control mr-2" value="<?php echo $search_query; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>            
        </div>
    </section>


    <div class="table-container">
    <table class="room-table">
        <thead>
            <tr>
                <th>Room Image</th>
                <th>Room Name</th>
                <th>Description</th>
                <th>Price (₹)</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($room = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><img src="uploads/<?php echo $room['room_image']; ?>" alt="Room Image" class="room-img"></td>
                <td><?php echo $room['room_name']; ?></td>
                <td><?php echo $room['room_description']; ?></td>
                <td>₹<?php echo $room['room_price']; ?></td>
                <td><?php echo $room['status']; ?></td>
                <td>
                    <a href="edit_room.php?id=<?php echo $room['id']; ?>" class="btn edit-btn">Edit</a>
                    <a href="delete_room.php?id=<?php echo $room['id']; ?>" onclick="return confirm('Are you sure you want to delete this room?');" class="btn delete-btn">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
            
</div>

            </body>
            </html>
