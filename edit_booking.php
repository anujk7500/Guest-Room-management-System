<?php
include 'config.php';
include 'sidebar.php';
session_start();



$search_query = "";
    if (isset($_GET['id'])) {
        $search_query = $_GET['id'];
    

$bookings_query = "
    SELECT b.id, r.room_name,b.check_in_date, b.check_out_date, b.total_price, u.name, r.room_price
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    JOIN users u ON b.user_id = u.id
    WHERE b.id = $search_query";
$bookings_result = mysqli_query($conn, $bookings_query);
$booking = mysqli_fetch_assoc($bookings_result);
$price_per_night = $booking['room_price'];

}

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];
    
    // Calculate total nights and total price
$check_in = new DateTime($check_in_date);
$check_out = new DateTime($check_out_date);
$nights = $check_out->diff($check_in)->days;
$total_price_new = $nights * $price_per_night;

    $update_query = "UPDATE bookings SET check_in_date='$check_in_date', check_out_date='$check_out_date', total_price='$total_price_new' WHERE id=$search_query";
    

    mysqli_query($conn, $update_query);
    header("Location: admin_dashboard.php");
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

<script>
        function calculatePrice() {
            const checkInDate = new Date(document.getElementById("check_in_date").value);
            const checkOutDate = new Date(document.getElementById("check_out_date").value);
            const pricePerNight = <?php echo $price_per_night; ?>;
            
            if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
                const nights = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
                const totalPrice = nights * pricePerNight;
                document.getElementById("total_price").textContent = "Total Price: ₹" + totalPrice.toFixed(2);
            } else {
                document.getElementById("total_price").textContent = "Select valid dates";
            }
        }
    </script>
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
            <label>Booking ID</label>
            <input type="text" name="room_name" class="form-control" value="<?php echo $booking['id']; ?>"  readonly>
        </div>
        <div class="form-group">        
            <label>Room Name</label>
            <input type="text" name="room_name" class="form-control" value="<?php echo $booking['room_name']; ?>" readonly>
        </div>

        <div class="form-group">        
            <label>Customer Name</label>
            <input type="text" name="room_name" class="form-control" value="<?php echo $booking['name']; ?>" readonly>
        </div>
     

        <div class="form-group">
            <label>check_in_date</label>
            <input type="date" name="check_in_date" id="check_in_date" class="form-control" value="<?php echo $booking['check_in_date']; ?>" required onchange="calculatePrice()">
        </div>

        <div class="form-group">
            <label>check_out_date</label>
            <input type="date" name="check_out_date" id="check_out_date" class="form-control" value="<?php echo $booking['check_out_date']; ?>" required onchange="calculatePrice()">
        </div>
        <div id="total_price" style="margin-top: 10px; font-weight: bold;">Total Price: ₹ <?php echo $booking['total_price']; ?></div>
<br>
        <button type="submit" class="edit-btn">Save Changes</button>
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