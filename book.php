
<?php
session_start();
include 'config.php';


if (isset($_GET['room_id'])) {
    $room_id = $_GET['room_id'];
    $user_id = $_SESSION['user_id'];
    $booking_date = date('Y-m-d');
    
    // Fetch room price for calculation
    $room_query = "SELECT room_price FROM rooms WHERE id = '$room_id'";
    $room_result = mysqli_query($conn, $room_query);
    $room = mysqli_fetch_assoc($room_result);
    $price_per_night = $room['room_price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Room</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* General modal styles */
.modal {
    display: flex;
    align-items: center;
    justify-content: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
}

.modal-content {
    background-color: #fff;
    padding: 20px;
    width: 400px;
    max-width: 90%;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.3);
    text-align: center;
}

/* Styling for the form */
.modal-content h2 {
    font-size: 1.5em;
    margin-bottom: 20px;
    color: #333;
}

.modal-content label {
    display: block;
    font-size: 1em;
    margin: 10px 0 5px;
    color: #555;
}

.modal-content input[type="date"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 1em;
}

#total_price {
    font-size: 1.2em;
    color: #333;
    margin-top: 15px;
}

/* Button styling */
.modal-content button {
    background-color: #4CAF50;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.modal-content button:hover {
    background-color: #45a049;
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

<div class="modal">
    <div class="modal-content">
        <h2>Enter Booking Details</h2>
        <form action="process_booking.php" method="POST">
            <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            <label for="check_in_date">Check-in Date:</label>
            <input type="date" id="check_in_date" name="check_in_date" required onchange="calculatePrice()">

            <label for="check_out_date">Check-out Date:</label>
            <input type="date" id="check_out_date" name="check_out_date" required onchange="calculatePrice()">

            <div id="total_price" style="margin-top: 10px; font-weight: bold;">Total Price: ₹ 0.00</div>

            <button type="submit">Confirm Booking</button>
        </form>
    </div>
</div>

</body>
</html>
