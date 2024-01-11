<?php

session_start();
if($_SESSION['role'] == 'superadmin'){
    include_once 'header-superadmin.php';
  }
else if($_SESSION['role'] == 'admin'){
  include_once 'header-admin.php';
}
else if($_SESSION['role'] == 'user'){
  include_once 'header-user.php';
}else{
  include_once 'header.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us | EkBar | World Largest liquor store</title>
    <link rel = "stylesheet" href = "css/contactus.css">
</head>
<body>
<section class = "contmain">
        <div class="contact-title">
            <h3>Contact us</h3>
        </div>
        <form action="https://formspree.io/f/xeqyjqzv"
  method="POST">
  <div class="form">
  <div class="outer">
     <div class="input"><input type="text" name="name" required placeholder = "Name"></div>
     <div class="input"><input type="email" name="email" required placeholder = "Email"></div>
     <div class="input"><input type="text" name="subject" required placeholder = "Subject"></div>
     </div>
     <div class="outer">
     <div class="input"><textarea name = "msg" required placedholder = "Type your message here"></textarea></div>
     </div>
  </div>
     <div class="button"><button type="submit">Send</button></div>   
</form>
<div class="container">
    <h1>We are now on</h1>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.2871487032817!2d79.91297311084008!3d6.97540851771724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2597c8dde7e47%3A0x341e7e820c46d3ed!2sUniversity%20of%20Kelaniya!5e0!3m2!1sen!2slk!4v1702661632659!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>
    </section>
</body>
</html>
<?php
include_once 'footer.php';
?>