<?php
include_once 'include/dbh.inc.php';
session_start();
if($_SESSION['role'] == 'admin'){
  include_once 'header-admin.php';
}
else if($_SESSION['role'] == 'user'){
  include_once 'header-user.php';
}else{
  include_once 'header.php';
}
if (isset($_SESSION["email"])) {
    $email  = $_SESSION["email"];
    $select = "SELECT * FROM users WHERE userEmail='$email'";
    $result = mysqli_query($connection, $select);
    $row    = mysqli_fetch_array($result);

    $userid = $row['usersid'];

    $tot_sql = "SELECT user_id , SUM(price * quantity) AS amount FROM cart WHERE user_id = '$userid'";
    $tot_result = mysqli_query($connection, $tot_sql);
    $tot_row = mysqli_fetch_array($tot_result);
    $total_amount = $tot_row['amount'];
    $_SESSION['tot'] = $total_amount;
} else {
    echo 'something wrong';
    header('Location:account.php');
    exit();
}

if (isset($_POST['submit'])) {
    $fname   = $_POST['first-name'];
    $lname   = $_POST['last-name'];
    $address = $_POST['address'];
    $mobile  = $_POST['mobile'];

    $select_update = "UPDATE users SET fname='$fname', lname='$lname', userMobile='$mobile', userAddress='$address' WHERE userEmail='$email'";
    mysqli_query($connection, $select_update);
    header("Location:pay.php");
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

    .checkout {
    margin:10%;
    position: relative;
    justify-content: center;
    align-items: center
    }
    .checkout h3{
        font-weight: bold;
    margin-bottom:2%;
    }
    .billing-details {
        border-radius: 2vh;
    margin: 2%;
    background-color: rgba(52, 52, 52, 0.113);
    padding: 4%;;
    box-shadow: 0px 0px 10px rgba(126, 126, 126, 0.5);
    }

    .order-details {
        padding: 4%;
       
       
        height: 40vh;
        
    margin: 2%;
   
    padding: 4%;;

    }
    .order-details h3{
        font-weight: bold;
    margin-bottom:2%;
    }

    .billing-details span {
        color: red;
    }

    .col-40 {
        float: left;
        width: 40%;
        padding: 6px 0;
    }

    .col-60 {
        float: left;
        width: 60%;
        padding: 6px 0;
        text-align: right;
        font-weight:bold;
    }

    #confirm-btn {
        float: right;
    }

    button {
        text-decoration: none;
        color: white;

        margin-top: 20px;
        padding: 12px 12px;
        border: none;
        background-color: #00A3FF;
        border-radius: 40px;
        width: 150px;
        font-weight: 600;
    }

    button a {
        text-decoration: none;
        color: white;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

        /* .col-40{
            width: 20%;
        } */
        .col-75,
        input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }
    label{
        text-align: center;
  margin :2% 0%;
    }
</style>
</head>
<body> 

<div class="checkout">
    <div class="main-topic">
        <h3>Checkout</h3>
    </div>

    <form action="" method="POST">

        <div class="billing-details">
            <h4>Billing Details</h4>

            <div class="row mb-2">
                <div style="width: 50%;">
                <label class="form-label" for="c-fname">First name <span>*</span></label>
                    <input type="text" name="first-name" id="c-fname" class="form-control" value="<?php echo $row['fname'] ?>">
                    
                </div>
                <div style="width: 50%;">
                <label class="form-label" for="c-lname">Last name <span>*</span></label>
                    <input type="text" name="last-name" id="c-lname" class="form-control" value="<?php echo $row['lname'] ?>">
                    
                </div>
            </div>
            <div class="mb-2">
            <label class="form-label" for="c-address">Address <span>*</span></label>
                <input type="text" name="address" id="c-address" class="form-control" value="<?php echo $row['userAddress'] ?>" required>
                
            </div>
            <div class="mb-2">
            <label class="form-label" for="c-email">Email <span>*</span></label>
                <input type="email" id="c-email" class="form-control" value="<?php echo $row['userEmail'] ?>">
                
            </div>

            <div class="mb-2">
            <label class="form-label" for="c-mobile">Mobile <span>*</span></label>
                <input type="text" name="mobile" id="c-mobile" class="form-control" value="<?php echo $row['userMobile'] ?>" required>
                
            </div>

        </div>
        <div class="order-details">
            <h4>Your Order Amount</h4>
            <div class="last-row">
                <p class="col-40"><strong>Total Amount</strong></p>
                <p class="col-60"><?php if (isset($total_amount)) echo $total_amount; else echo  0; ?></p>
            </div>
            <button type="submit" name="submit" id="confirm-btn"><a href="pay.php">Go To Pay</a></button>
    </form>

</div>

</body>
</html>
<?php
include_once 'footer.php';
?>