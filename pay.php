<?php
if($_SESSION['role'] == 'admin'){
    include_once 'header-admin.php';
  }
  else if($_SESSION['role'] == 'user'){
    include_once 'header-user.php';
  }
  include_once 'connect.php';
  session_start();
  
  if (isset($_SESSION["email"])) {
      $email  = $_SESSION["email"];
      $select = "SELECT * FROM users WHERE userEmail='$email'";
      $result = mysqli_query($conn, $select);
      $row    = mysqli_fetch_array($result);
  if($row['userAddess'] == '' || $row['userMobile'] == '' ){
    header('Location:checkout.php');
  }else{
    $userid = $row['usersid'];
    $fname = $row['fname'];
    $fname = $row['fname'];
    $fname = $row['fname'];
    $fname = $row['fname'];
    $fname = $row['fname'];
  }
      
  
      $tot_sql = "SELECT user_id , SUM(price * quantity) AS amount FROM cart WHERE user_id = '$userid'";
      $tot_result = mysqli_query($connection, $tot_sql);
      $tot_row = mysqli_fetch_array($tot_result);
      $total_amount = $tot_row['amount'];
  } else {
      echo 'something wrong';
      header('Location:account.php');
      exit();
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
    
</body>
</html>