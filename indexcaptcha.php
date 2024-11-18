<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['captcha'] != $_SESSION['captcha_code']) {
        $captcha_error = "CAPTCHA answer is incorrect. Please try again.";
    } else {
        // Process login form
    }
}

$captcha_code = '';
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_code'] = $captcha_code;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Guest Room Booking</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        function refreshCaptcha() {
            const captchaImg = document.getElementById('captcha-img');
            captchaImg.src = 'captcha.php?' + Date.now(); // Append timestamp to prevent caching
        }
    </script>
    <style>
        .banner_main {
            background-image: url('images/banner3.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .refresh-icon {
            color: white; /* Makes the icon white */
        }
    </style>
</head>
<body class="main-layout">
    <header>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                            <div class="center-desk">
                                <div class="logo">
                                    <a href="index.php">Guest Room Booking Management System</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                        <nav class="navigation navbar navbar-expand-md navbar-dark">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarsExample04">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
                                    <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                                    <li class="nav-item"><a class="nav-link" href="room.html">Our Room</a></li>
                                    <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="contact.html">Contact Us</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section class="banner_main">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="book_room">
                        <h1>USER LOGIN</h1>
                        <form action="index.php" method="POST" class="book_now">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Username</span>
                                    <input class="online_book" placeholder="Enter your username" type="text" name="username" required>
                                </div>
                                <div class="col-md-12">
                                    <span>Password</span>
                                    <input class="online_book" placeholder="Enter your password" type="password" name="password" required>
                                </div>
                                <div class="col-md-12">
                                    <span><?php if (isset($captcha_error)) echo $captcha_error; ?></span>
                                    <span>CAPTCHA:</span>
                                    <img id="captcha-img" src="captcha.php" alt="CAPTCHA Image" style="vertical-align: middle; margin-right: 10px;">
                                    <button type="button" onclick="refreshCaptcha()" style="border: none; background: none; cursor: pointer;">
                                        <i class="fas fa-sync-alt refresh-icon" style="font-size: 24px;"></i>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <input class="online_book" placeholder="Enter CAPTCHA" type="text" name="captcha" required>
                                </div>
                                <div class="col-md-12">
                                    <button class="book_btn" type="submit">Login</button>
                                </div>
                                <div class="col-md-12">
                                    <p>Don't Have an account? <a href="register.php"><span>Register Here</span></a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
