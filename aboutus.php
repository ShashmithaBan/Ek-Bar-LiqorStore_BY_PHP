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
    <link rel = "stylesheet" href = "css/aboutus.css">
</head>
<body>
<section class = "abmain">
        <div class="about-title">
            <h3>About us</h3>
            
        </div>
        <div class="about-text">
            Wine World is the highest acclaimed premium wines and spirits concierge service in Sri Lanka who’s purpose is to satisfy and cater to the unique beverage needs of all Sri Lankans.<br>
Our website offers an exclusive product portfolio extending from Wines, to Whiskeys, to Brandies, to Arracks and many other genres of spirits sourced from all over the world, which could now be received by you right on to your door step in 2 to 7 days, anywhere in the island!<br><br>
<span>Find out more on Concierge services</span><br>
The services we offer include;<br>
<ul>
    <li>
        Concierge Services for premium wines and spirits – WineWorld.lk does not in any way have legal ownership of the items sold on its digital platforms and all payments made through online purchases are directly paid to the vendor of the stocks. We are a mere concierge service and the only income recognized by us is the charge for the concierge service
    </li>
    <li>
        Bar Services – We provide a full bar service for corporate and social functions, offering expert advice and creative solutions to diverse requirements. Over the years we have been privileged to partner with events hosted by RedBull, HSBC, Colombo Fashion Week, and many more esteemed organizations.
    </li>
    <li>
        We curate premium spirits and wine evenings conducted by local and international sommeliers.
    </li>
    <li>
        Hampers & Gifting Solutions – Leave it to our team to customize your order to suit your requirement. We provide tailor made corporate hampers for all occasions with no hidden charges.
    </li>
</ul>

<span>Start Shopping Now!</span>
<a href = "index.php">Click Here</a>
<div class="about-img"><img src = "Source/main_logo.png"></div>
        </div>
    </section>
</body>
</html>
<?php
include_once 'footer.php';
?>