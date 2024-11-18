<?php
session_start();
include 'config.php';

if (isset($_POST['user_id'], $_POST['room_id'], $_POST['check_in_date'], $_POST['check_out_date'])) {
    $user_id = $_POST['user_id'];
    $room_id = $_POST['room_id'];
    $check_in_date = $_POST['check_in_date'];
    $check_out_date = $_POST['check_out_date'];

    // Calculate total nights and total price
    $check_in = new DateTime($check_in_date);
    $check_out = new DateTime($check_out_date);
    $nights = $check_out->diff($check_in)->days;

    // Fetch room price
    $room_query = "SELECT room_price FROM rooms WHERE id = '$room_id'";
    $room_result = mysqli_query($conn, $room_query);
    $room = mysqli_fetch_assoc($room_result);
    $price_per_night = $room['room_price'];
    $total_price = $nights * $price_per_night;

    // Insert booking record
    $sql = "INSERT INTO bookings (user_id, room_id, check_in_date, check_out_date, total_price) 
            VALUES ('$user_id', '$room_id', '$check_in_date', '$check_out_date', '$total_price')";

    if (mysqli_query($conn, $sql)) {
        // Show success message with JavaScript
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showSuccessMessage('Room booked successfully for ₹ $total_price!');
                window.Location('index.php');
            });
        </script>";
    } else {
        echo "<div class='error-message'>Error booking the room. Please try again.</div>";
    }
} else {
    echo "<div class='error-message'>Invalid booking data.</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Room Booking</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Modal styling */
.modal {
    display: none; 
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #fff;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 50%;
    border-radius: 8px;
    text-align: center;
}

.modal-content button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 4px;
    margin-top: 15px;
}

.modal-content button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>

<!-- Success Message Modal -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span id="successText"></span>
        <button onclick="closeModal()">OK</button>
    </div>
</div>

<script>
    // Function to display the success message
    function showSuccessMessage(message) {
        document.getElementById('successText').innerText = message;
        document.getElementById('successModal').style.display = 'block';
    }

    // Function to close the modal
    function closeModal() {
    document.getElementById('successModal').style.display = 'none';
    window.location.href = 'booking.php'; // Redirect to index page
}
</script>

</body>
</html>
