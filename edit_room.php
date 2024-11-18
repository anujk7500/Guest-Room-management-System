<?php
include 'config.php';
include 'sidebar.php';
session_start();



$search_query = "";
    if (isset($_GET['id'])) {
        $search_query = $_GET['id'];
    

$bookings_query = "SELECT * FROM rooms where id=$search_query";
$bookings_result = mysqli_query($conn, $bookings_query);
$room_result = mysqli_fetch_assoc($bookings_result);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room_name = $_POST['room_name'];
    $status = $_POST['status'];
    $price = $_POST['room_price'];
    $description = $_POST['room_description'];

    // Handle image upload
    if (!empty($_FILES['room_image']['name'])) {
        $image_name = $_FILES['room_image']['name'];
        $image_tmp_name = $_FILES['room_image']['tmp_name'];
        $image_path = 'uploads/' .  basename($image_name);
        move_uploaded_file($image_tmp_name, $image_path);

        $update_query = "UPDATE rooms SET room_name='$room_name', status='$status', room_price='$price', room_description='$description', room_image='$image_name' WHERE id=$search_query";
    } else {
        $update_query = "UPDATE rooms SET room_name='$room_name', status='$status', room_price='$price', room_description='$description' WHERE id=$search_query";
    }

    mysqli_query($conn, $update_query);
    header("Location: manage_rooms.php");
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
    

    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">        
            <label>Room Name</label>
            <input type="text" name="room_name" class="form-control" value="<?php echo $room_result['room_name']; ?>" required>
        </div>

        <div class="form-group">        
            <label>room_description</label>
            <input type="text" name="room_description" class="form-control" value="<?php echo $room_result['room_description']; ?>" required>
        </div>

               
        <div class="form-group">
            <label>Price</label>
            <input type="number" name="room_price" class="form-control" value="<?php echo $room_result['room_price']; ?>" required>
        </div>

         <div class="form-group">
            <label>Status</label>
            <input type="text" name="status" class="form-control" value="<?php echo $room_result['status']; ?>"required>
        </div>

        <label for="room_image">Room Image:</label>
        <input type="file" id="room_image" name="room_image" accept="image/*" required>
        
        <button type="submit" class="btn btn-success btn-block">Save Changes</button>
        <a href="admin_dashboard.php" class="btn btn-secondary btn-block">Cancel</a>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.style.display = 'block';
    }
</script>
</body>
</html>