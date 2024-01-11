<?php
include_once 'header.php';
include_once './include/dbh.inc.php';


// signup
    if(isset($_POST['submit'])){

    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role  = 'user';
    $pass  = md5($_POST['passwd']);
    $cpass = md5($_POST['re_passwd']);

    $select = " SELECT * FROM users WHERE userEmail = '$email'";
    $result = mysqli_query($connection, $select);

    if((empty($fname) || empty($lname) || empty($_POST['passwd'])|| empty($_POST['re_passwd']))){
        if(empty($fname)){
            $error[] = 'First Name is Empty';
        } else if(empty($lname)){
            $error[] = 'Last Name is Empty';
        } else if(empty($email)){
            $error[] = 'Email is Empty';
        } else if(empty($_POST['passwd'])|| empty($_POST['re_passwd'])){
            $error[] = 'Password is Empty';
        }
    } else if ((mysqli_num_rows($result)) > 0) {
        $error[] = 'User Already Exist!';
    } else {
        if (($_POST['passwd'])!=($_POST['re_passwd'])) {
            $error[] = 'Password not Matched!';
        } else {
            $insert = "INSERT INTO users (fname, lname, userEmail,userPwd,role) VALUES('$fname','$lname','$email','$pass','$role')";
            mysqli_query($connection, $insert);
            $message[] = 'Registered Successfully - Please Login Again';
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/account.css">
    <style>
        .main .error-msg {
            margin: 10px auto;
            display: block;
            width: 50vh;
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            border-radius: 1vh;
            font-size: 13px;
            padding: 10px;
            text-align: center;
        }
        .main .success-msg{
            margin: 10px auto;
            display: block;
            width: 50vh;
            background-color: #d8f8d7;
            color: #1c723a;
            border: 2px solid #d8f8d7;
            border-radius: 1vh;
            font-size: 1vh;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>


    <div class="main">
        <h2 class="main-topic">My Account</h2>

        <div class="error">
            <div>
        <?php
        
        if (isset($error)) {
            foreach ($error as $error) {
                echo '<span class="error-msg">' . $error . '</span>';
            };
        }else
            if(isset($_GET["error"])){
                if($_GET["error"]=="emptyemail"){
                    echo '<span class="error-msg">' . 'Email is Empty' . '</span>';
                } else if($_GET["error"]=="emptypassword"){
                    echo '<span class="error-msg">' . 'Password is Empty' . '</span>';
                } else if($_GET["error"]=="incorrectPassword"){
                    echo '<span class="error-msg">' . 'Incorrect Password' . '</span>';
                }else if($_GET["error"]=="userNotExisting"){
                    echo '<span class="error-msg">' . 'User is not Existing' . '</span>';
                }else if($_GET["error"]=="emptyemailpass"){
                    echo '<span class="error-msg">' . 'Both Email & Password is Empty' . '</span>';
                }
        }if(isset($message)){
                echo '<span class="success-msg">Registered Successfully - Please Login Again</span>';
        
        };
        
        
        ?>
        </div>
        </div>

        <div class="account">
            <div>
                <section class="login-full">
                    
                    <div class="login-form">
                        <form action="./include/login.inc.php" method="POST">
                        

                            <h3 class="text-uppercase text-center mb-5" id="form_heading">Log in</h3>

                            <div>
                                <input type="email" name="email" class="text-box" id="login-email" placeholder="Enter Email"/>
                            </div>

                            <div>
                                <input type="password" name="passwd" class="text-box" placeholder="Enter Password"/>
                            </div>

                            <div class="forgot_pwd">
                                <a href="">Forgot Password?</a>
                            </div>

                            <div class="form-check d-flex justify-content-start mb-4" id="rem">
                                <input class="checkbox-rem-pwd" type="checkbox" value="" id="rem-passwd" />
                                <label for="rem-passwd"> &nbsp;&nbsp;Remember password </label>
                            </div>

                            <button class="button" name="submit" type="submit">Login</button>

                            <div class="divider d-flex align-items-center my-2">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                            </div>

                            <button class="button" style="background-color: #3b5998;" type="submit" id="facebook"><i class="fab fa-facebook-f me-2"></i><a href="https://www.facebook.com/">Sign in with facebook</a></button>
                            <button class="button" style="background-color: #dd4b39;" type="submit" id="google"><i class="fab fa-google me-2"></i> Sign in with google</button>
                        </form>
                        <?php
                            
                        ?>
                    </div>
                </section>
            </div>
            <div>
                <section class="signup-full">
                    <div class="signup-form">
                        <h3 class="text-uppercase text-center mb-5" id="form_heading">Register</h3>

                        <form action="" method="POST">
                    
                            <div class="row">
                                <div class="name">
                                    <div>
                                        <input type="text" name="fname" class="ftext-box" placeholder="First Name"/>
                                    </div>

                                    <div>
                                        <input type="text" name="lname" class="ltext-box" placeholder="Last Name"/>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <input type="email" name="email" class="text-box" placeholder="Email"/>
                            </div>

                            <div>
                                <input type="password" name="passwd" class="text-box" placeholder="Passwaord"/>
                            </div>

                            <div>
                                <input type="password" name="re_passwd" class="text-box" placeholder="Repeat Password"/>
                            </div>

                            <div class="form-check d-flex justify-content-center mb-1">
                            </div>

                            <button class="button" name="submit" type="submit">Register</button>

                            <div class="divider d-flex align-items-center my-2">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">OR</p>
                            </div>

                            <button class="button" style="background-color: #3b5998;" type="submit" id="facebook"><i class="fab fa-facebook-f me-2"></i><a href="https://www.facebook.com/">Sign in with facebook</a></button>
                            <button class="button" style="background-color: #dd4b39;" type="submit" id="google"><i class="fab fa-google me-2"></i> Sign in with google</button>

                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>


<?php
include_once 'footer.php';
?>