<?php
include 'config.php';
include 'sidebar.php';

session_start();

// Fetch user data
$query = "SELECT id, name, email FROM users ORDER BY id DESC";
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>



<!-- Main content area -->
<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Customer Management</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

    <section id="recent-bookings">
        <div class="search-container">
            
            <form action="manage_customers.php#recent-bookings" method="GET" class="form-inline my-3">
                <input type="text" name="search" placeholder="Search by customers name..." class="form-control mr-2" value="<?php echo $search_query; ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>            
        </div>
    </section>






<div class="table-container">
    <table class="styled-table">
        <thead>
            <tr>
                <th>SL No</th>
                <th>Name</th>
                <th>Email</th>
                
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $count=1;
            while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a href="edit_customer.php?id=<?php echo $row['id']; ?>" class="btn edit-btn">Edit</a>
                    <a href="delete_customer.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this room?');" class="btn delete-btn">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
// JavaScript functions for edit and delete actions
function editCustomer(id) {
    window.location.href = `edit_customer.php?id=${id}`;
}

function deleteCustomer(id) {
    if (confirm("Are you sure you want to delete this customer?")) {
        window.location.href = `delete_customer.php?id=${id}`;
    }
}
</script>
