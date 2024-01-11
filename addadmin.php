<?php

include 'connect.php';
session_start();
  include 'header-superadmin.php';

if(isset($_POST['submit'])){

    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $pass=md5($_POST['pass']);
    $role= 'admin';
    $sql = "INSERT INTO users (fname, lname, userMobile ,userEmail, userPwd , role) VALUES (?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location:../signup.php?error=stmtfailed");
        exit();
    }
    $result = mysqli_stmt_bind_param($stmt,"ssisss", $fname,$lname,$phone,$email,$pass,$role);
    mysqli_stmt_execute($stmt);
    if($result){
        $message[]='Admin Added Succesfully';
    }
    mysqli_stmt_close($stmt);
    header("Location:addadmin.php");
    exit();

   
       



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin | Ek Bar</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter&family=PT+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="Source/Header_logo.png" type="image/x-icon">
    <link rel = "stylesheet" href = "css/addprod.css">
    <link rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
</head>
<body>
<div class="product-container">
            <h3>Add Admin</h3>
            <form action="" method="POST" enctype="multipart/form-data">
            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>

      <div class="indiv">
      <span> First Name</span>
            <input type="text" name="fname" class="box" placeholder="First Name" id="" required>
            <span>Last Name</span>
            <input type="text" name="lname" class="box" placeholder="Last Name" id="" required>
            <span>Mobile Number</span>
            <input type="number" name="phone" class="box" placeholder="Mobile Number" id="" required>
            <span>Email</span>
            <input type="email" name="email" class="box" placeholder=" Email" id="" required>
           


      </div>

      <div class="indiv">
      <span>Password</span>
      <input type="password" name="pass" class="box" placeholder=" Password" id="" required>    
            
  </div>

      <input type="submit" name="submit" value="Add Admin" class="btn" >
            
           
           
             
        </form>
    </div>
</body>
</html>
<?php
include_once 'footer.php';

?>
