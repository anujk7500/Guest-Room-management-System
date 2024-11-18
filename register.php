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
                           <h1>USER REGISTRATION</h1>
                           <form action="register.php" method="POST" class="book_now" >
                              <div class="row">
                                <div class="col-md-12">
                                    <span>FullName</span>
                                    <img class="date_cua" src="images/user.png">
                                    <input class="online_book" placeholder="Enter your fullname" type="text" name="name" required>
                                 </div>
                                 <div class="col-md-12">
                                    <span>Username</span>
                                    <img class="date_cua" src="images/email.png">
                                    <input class="online_book" placeholder="Enter your email" type="email" name="email" required>
                                 </div>
                                 <div class="col-md-12">
                                    <span>Password</span>
                                    <img class="date_cua" src="images/password.png">
                                    <input class="online_book" placeholder="Enter your password" type="password" name="password" required>
                                 </div>
                                 <div class="col-md-12">
                                    <button class="book_btn" type="submit">Sign Up</button>
                                 </div>
                                 <div class="col-md-12">
                                    <p>Already Have an Account? <a href="index.php"><span>Login Here</span></a></p>
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
    
    
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
     
   </body>
</html>

<?php

include("config.php");
// register.php backend logic

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    mysqli_query($conn, $sql);
    echo "<div class='message'>Registration Successful!</div>";
}
?>
<?php
    include 'footer.php';
?>