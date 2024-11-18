<?php
include 'config.php';
session_start();
$error_message = '';

// Default admin credentials
$default_admin_email = "admin@gr.com";
$default_admin_password = "admin@123";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
   $email = $_POST['email'];
    $password = $_POST['password'];

    

    // Check for default admin credentials
    if ($email === $default_admin_email && $password === $default_admin_password) {
        // Set session variables for admin
        $_SESSION['user_name'] = 'Admin';
        $_SESSION['user_role'] = 'admin';

        // Redirect to admin dashboard
        header("Location: admin_dashboard.php");
        exit();
    }

    // Check if user exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables for logged-in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        // Redirect to the booking page
        header("Location: booking.php");
        exit();
    } else {
        $error_message = "Invalid email or password.";
    }
   

}



?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Guest Room-Booking</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

      

   </head>
   <!-- body -->
   <body class="main-layout">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#"/></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         <div class="header">
            <div class="container">
               <div class="row">
                  <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                     <div class="full">
                        <div class="center-desk">
                           <div class="logo">
                           
                           <h1 style="font-size: 30px;padding: 0 0 0 70px;color:red;font-weight:bold;"><a href="index.html">GRMS</a></h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                     <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                           <ul class="navbar-nav mr-auto">
                              <li class="nav-item active">
                                 <a class="nav-link" href="index.php">Home</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="about.php">About</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="room.php">Our room</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="gallery.php">Gallery</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="blog.php">Blog</a>
                              </li>
                              <li class="nav-item">
                                 <a class="nav-link" href="contact.php">Contact Us</a>
                              </li>
                           </ul>
                        </div>
                     </nav>
                  </div>
               </div>
            </div>
         </div>
      </header>
      <!-- end header inner -->
      <!-- end header -->
      <!-- banner -->
      
      <section class="banner_main">
            <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
               <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <img class="first-slide" src="images/banner1.jpg" alt="First slide">
                     <div class="container">
                     </div>
                  </div>
                  <div class="carousel-item">
                     <img class="second-slide" src="images/banner2.jpg" alt="Second slide">
                  </div>
                  <div class="carousel-item">
                     <img class="third-slide" src="images/banner3.jpg" alt="Third slide">
                  </div>
               </div>
               <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
               <span class="carousel-control-prev-icon" aria-hidden="true"></span>
               <span class="sr-only">Previous</span>
               </a>
               <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
               <span class="carousel-control-next-icon" aria-hidden="true"></span>
               <span class="sr-only">Next</span>
               </a>
            </div>
            <div class="booking_ocline">
               <div class="container">
                  <div class="row">
                     <div class="col-md-5">
                        <div class="book_room">
                           <h1>USER LOGIN</h1>
                           <form action="index.php" method="POST" class="book_now" >
                              <div class="row">
                                 <div class="col-md-12">
                                    <span>Username</span>
                                    <img class="date_cua" src="images/user.png">
                                    <input class="online_book" placeholder="Enter your username" type="email" name="email" required>
                                 </div>

                                 <div class="col-md-12">
                                    <span>Password</span>
                                    <img class="date_cua" src="images/password.png">
                                    <input class="online_book" placeholder="Enter your password" type="password" name="password" required>
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
            </div>
         </section>
      <!-- end banner -->

      <!-- footer -->
     
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-10 offset-md-1">
                        
                     <p>
                           © 2024 All Rights Reserved. Design by <a href="#"> TEAM UAV</a>
                     
                           </p>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      
   
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script>
        function refreshCaptcha() {
            const captchaImg = document.getElementById('captcha-img');
            captchaImg.src = 'captcha.php?' + Date.now(); // Append timestamp to prevent caching
        }
    </script>
   </body>
</html>