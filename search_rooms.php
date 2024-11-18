<?php
session_start();
include 'config.php';

// Fetch username for display
$username = $_SESSION['user_name']; // Assuming username is stored in session

// Handle search query
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$rooms = [];

if ($search) {
    $query = "SELECT * FROM rooms WHERE room_name LIKE '%$search%' OR id LIKE '%$search%'";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $rooms[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Rooms - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        /* Extend admin dashboard styles */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            min-height: 100vh;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header .username {
            font-size: 18px;
            color: #343a40;
        }
        .header .profile-icon {
            margin-left: 8px;
            font-size: 18px;
            color: #6c757d;
        }

        /* Search Results Table */
        .results-container {
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 20px;
        }
        .results-container h2 {
            font-size: 24px;
            color: #343a40;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #e0e0e0;
        }
        th, td {
            padding: 12px;
            text-align: center;
            color: #343a40;
        }
        th {
            background-color: #f8f9fa;
        }
        .no-results {
            text-align: center;
            color: #dc3545;
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Admin Dashboard</h2>
    <a href="admin_dashboard.php">Overview</a>
    <a href="admin_dashboard.php#manage-rooms">Manage Rooms</a>
    <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="main-content">
    <!-- Header with username and profile icon -->
    <div class="header">
        <h1>Search Rooms</h1>
        <div class="user-info">
            <span class="username"><?php echo $username; ?></span>
            <i class="fas fa-user-circle profile-icon"></i>
        </div>
    </div>

    <!-- Search Results -->
    <div class="results-container">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
        <?php if ($rooms): ?>
            <table>
                <tr>
                    <th>Room ID</th>
                    <th>Room Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($rooms as $room): ?>
                    <tr>
                        <td><?php echo $room['id']; ?></td>
                        <td><?php echo $room['room_name']; ?></td>
                        <td><?php echo $room['status']; ?></td>
                        <td>
                            <a href="edit_room.php?id=<?php echo $room['id']; ?>">Edit</a> |
                            <a href="update_status.php?id=<?php echo $room['id']; ?>">Update Status</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="no-results">No rooms found matching "<?php echo htmlspecialchars($search); ?>"</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
