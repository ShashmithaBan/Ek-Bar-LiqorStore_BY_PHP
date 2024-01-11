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
    <title>Document</title>
</head>
<body>
    <div class="main">
        <div class="heading">

        </div>
        <div class="text">
            <p>Product returns due to any reason whatsoever shall not be entertained provided any manufacturing defect and/or physical damage shall be inquired into and verified at the sole discretion of the vendor.</p>
            <p>A customer will only be eligible for a Return or Refund if Wine World is unable to fulfill the placed order or based on below scenarios;</p>
            
        <h3>Returns</h3>
        <p>A customer will only be eligible for a Return or Refund if Wine World is unable to fulfill the placed order or based on below scenarios;</p>
        <p>A customer will only be eligible for a Return or Refund if Wine World is unable to fulfill the placed order or based on below scenarios;</p>
        <h3>Refunds/ Replacements For Missing Item(s)</h3>
        <p>
           1. At the point of receipt please ensure you check that the items received are in order in the presence of the concierge and raise it to them if there are any missing item(s).</p>
        <p>2. If there are missing item(s) – Note down the number of bottles actually received on the invoice and get the concierge to place a signature with the name and contact number confirming the quantity so that the Wine World team can further investigate. If this process is not followed, complaints of missing items via phone call/ email after the concierge has left the premises will be considered unviable.</p>
        <p>3. If this process is followed and an image/scanned copy of the concierge signed document is emailed to wwinfo@wineworld.lk with a complaint, the missing item(s) will be replaced as soon as possible to the customer or a refund will be arranged – as per preference.</p>
        </div>
    </div>
</body>
</html>