<?php
session_start();

// Generate random CAPTCHA code
// $captcha_code = '';
// $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
// for ($i = 0; $i < 6; $i++) {
//     $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
// }
// $_SESSION['captcha_code'] = $captcha_code;

// header('Content-Type: image/png');

// // Create the image
// $image = imagecreate(130, 50);
// $background = imagecolorallocate($image, 255, 255, 255); // White background
// $text_color = imagecolorallocate($image, 0, 0, 0); // Black text

// // Path to the font file (ensure it exists)
// $font = __DIR__ . 'C:/Windows/Fonts/arial.ttf'; // Adjust path if needed

// // Check if the font file exists
// if (!file_exists($font)) {
//     die('Font file is missing or path is incorrect!');
// }

// // Add the CAPTCHA text to the image
// imagettftext($image, 20, 0, 15, 30, $text_color, $font, $captcha_code);

// // Output the image
// imagepng($image);
// imagedestroy($image);

// session_start();

// Generate a random CAPTCHA code
$captcha_code = '';
$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
for ($i = 0; $i < 6; $i++) {
    $captcha_code .= $characters[rand(0, strlen($characters) - 1)];
}
$_SESSION['captcha_code'] = $captcha_code;

header('Content-Type: image/png');

// Create the image
$image = imagecreate(130, 50); // Width and height of the image
$background = imagecolorallocate($image, 255, 255, 255); // White background
$text_color = imagecolorallocate($image, 0, 0, 0); // Black text

// Use a system font or ensure that arial.ttf is present
$font = __DIR__ . '/arial.ttf'; // Change this path if necessary
if (!file_exists($font)) {
    die('Font file is missing or path is incorrect!');
}

// Add the CAPTCHA code to the image
imagettftext($image, 20, 0, 15, 30, $text_color, $font, $captcha_code);

// Output the image
imagepng($image);
imagedestroy($image);



?>


