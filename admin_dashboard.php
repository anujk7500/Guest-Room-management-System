<?php
session_start();
include 'config.php';
include 'sidebar.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: index.php"); // Redirect to login page if not admin
    exit();
}

// Fetch room statistics for graphs
$booked_rooms_query = "SELECT COUNT(*) AS booked_count FROM rooms WHERE status = 'Booked'";
$booked_rooms_result = mysqli_fetch_assoc(mysqli_query($conn, $booked_rooms_query));

$available_rooms_query = "SELECT COUNT(*) AS available_count FROM rooms WHERE status = 'Available'";
$available_rooms_result = mysqli_fetch_assoc(mysqli_query($conn, $available_rooms_query));

$total_rooms = $booked_rooms_result['booked_count'] + $available_rooms_result['available_count'];

// Fetch username for display
$username = $_SESSION['user_name'];

// Search functionality
$search_query = "";
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Fetch recent bookings
$bookings_query = "
    SELECT b.id, r.room_name, b.check_in_date, b.check_out_date, b.total_price, u.name AS user_name
    FROM bookings b
    JOIN rooms r ON b.room_id = r.id
    JOIN users u ON b.user_id = u.id
    WHERE r.room_name LIKE '%$search_query%'
    ORDER BY b.check_in_date DESC
    LIMIT 7
";
$bookings_result = mysqli_query($conn, $bookings_query);
if (isset($_POST['generate_report'])) {
    $report_date = $_POST['report_date'];
    
    // Fetch bookings for the selected date
    $report_query = "SELECT * FROM bookings WHERE booking_date = '$report_date' LIMIT 7";
    $report_result = mysqli_query($conn, $report_query);

    echo '<div class="report-table">';
    echo '<table>';
    echo '<tr><th>Booking ID</th><th>User ID</th><th>Room ID</th><th>Check-in Date</th><th>Check-out Date</th><th>Total Price</th></tr>';

    while ($booking = mysqli_fetch_assoc($report_result)) {
        echo "<tr>
                <td>{$booking['booking_id']}</td>
                <td>{$booking['user_id']}</td>
                <td>{$booking['room_id']}</td>
                <td>{$booking['check_in_date']}</td>
                <td>{$booking['check_out_date']}</td>
                <td>₹{$booking['total_price']}</td>
              </tr>";
    }
    echo '</table>';
    echo '<button onclick="window.print()">Print Report</button>';
    echo '</div>';
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
        <h1>Dashboard Overview</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

    <!-- Chart section -->
    <section id="overview">
        <div class="chart-container">
            <canvas id="roomStatusChart"></canvas>
        </div>
    </section>

    <!-- Search and display recent bookings section -->
    <section id="recent-bookings">
        <div class="search-container">
            <h2>Recent Bookings</h2>
            <form action="admin_dashboard.php#recent-bookings" method="GET" class="form-inline my-3">
                <input type="text" name="search" placeholder="Search by room name..." class="form-control mr-2" value="<?php echo $search_query; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>            
        </div>
    </section>

    <!-- To genarate reports -->
    <!-- <section id="daily-report">
    <h2>Generate Daily Booking Report</h2>
    <form method="POST" action="">
        <label for="report_date">Select Date:</label>
        <input type="date" name="report_date" id="report_date" required>
        <button type="submit" name="generate_report">Generate Report</button>
    </form>
    </section> -->

    <!-- To show recent 7 booking orders -->

    <section id="recent-bookings">
        <h2>Recent Bookings</h2>
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
                        <td><?php echo $booking['user_name']; ?></td>
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

<!-- Chart.js Script for Room Status -->
<script>
const ctx = document.getElementById('roomStatusChart').getContext('2d');
const roomStatusChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: ['Booked Rooms', 'Available Rooms'],
        datasets: [{
            label: 'Room Status',
            data: [<?php echo $booked_rooms_result['booked_count']; ?>, <?php echo $available_rooms_result['available_count']; ?>],
            backgroundColor: ['#FF6384', '#36A2EB'],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
    }
});


</script>
<script>
function printReport() {
    window.print();
}
</script>

</body>
</html>
