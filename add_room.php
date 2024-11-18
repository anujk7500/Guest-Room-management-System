<?php
session_start();
include 'config.php';
include 'sidebar.php';

// Check if user is admin
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

$error_message = '';
$success_message = '';

// Handle form submission
if (isset($_POST['add_room'])) {
    $room_name = $_POST['room_name'];
    $room_description = $_POST['room_description'];
    $room_price = $_POST['room_price'];
    $room_status = $_POST['status'];
    $room_image = $_FILES['room_image']['name'];

    // Upload Image
    $target_directory = "uploads/";
    $target_file = $target_directory . basename($room_image);

    if (move_uploaded_file($_FILES['room_image']['tmp_name'], $target_file)) {
        // Insert room data into database
        $sql = "INSERT INTO rooms (room_name, room_description, room_price, status, room_image) 
                VALUES ('$room_name', '$room_description', '$room_price', '$room_status', '$room_image')";
        
        if (mysqli_query($conn, $sql)) {
            $success_message = "Room added successfully!";
        } else {
            $error_message = "Error adding room: " . mysqli_error($conn);
        }
    } else {
        $error_message = "Error uploading image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Room - Admin</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="admin_booking.css">
    <link rel="stylesheet" href="add_room.css">
</head>
<body>
   

<!-- Main content area -->
<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Adding Rooms</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div><br>
<div class="form-container">
    <h2>Add New Room</h2>

    <?php if ($success_message): ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="add_room.php" method="POST" enctype="multipart/form-data">
        <label for="room_name">Room Name:</label>
        <input type="text" id="room_name" name="room_name" required>

        <label for="room_description">Room Description:</label>
        <textarea id="room_description" name="room_description" required></textarea>

        <label for="room_price">Room Price (₹):</label>
        <input type="number" id="room_price" name="room_price" required>

        <label for="room_status">Room Status:</label>
        <select id="room_status" name="status" required>
            <option value="Available">Available</option>
            <option value="Booked">Booked</option>
        </select>

        <label for="room_image">Room Image:</label>
        <input type="file" id="room_image" name="room_image" accept="image/*" required>

        <button type="submit" name="add_room">Add Room</button>
    </form>
</div>
</body>
</html>

