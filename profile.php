<?php
include'connect.php';
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

if (!isset($_SESSION["email"])) {
    echo 'something wrong';
    header('Location:account.php');
    exit();
}

$name = $_SESSION['fname'].' '.$_SESSION['lname'];
$phone = $_SESSION['phone'];
$email = $_SESSION['email'];
$address = $_SESSION['address'];

// Check if the user is logged in and has a valid session
if (!isset($_SESSION["email"])) {
    echo 'Something wrong';
    header('Location: account.php');
    exit();
}

// Function to handle file upload
function uploadProfileImage($userId) {
    $targetDirectory = "uploaded_img/"; // Specify the directory where you want to store uploaded images
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image or a fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["file"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (you can adjust the file size limit as needed)
    if ($_FILES["file"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {

            $updateQuery = "UPDATE users SET image = '$targetFile' WHERE id = $userId";

            if ($conn->query($updateQuery) === TRUE) {
                // Update the session variable with the new image path
                $_SESSION["profile_image"] = $targetFile;
                echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded and database updated.";
            } else {
                echo "Error updating database: " . $conn->error;
            }
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

if(isset($_POST['submit'])){
    if (isset($_FILES["file"])) {
        uploadProfileImage($_SESSION['id']); // Replace 'user_id' with the actual session variable storing the user's ID
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .profile-details {
        margin:5% 10%;
    padding:0% 3%;
        align-items: center;
    }
    .user-name{
        font-size:2.5vh;
        font-weight:bold;
    }

    .profile-info, .order-list-info, .order-delivery-info{
        z-index: 2;
        margin: 0% 8%;
        padding: 0 10%;
        max-width: 90%;
        align-content: center;
        /* display:flex; */
        justify-content:center;
        align-items:center;
    }

    /* form{
        align-self: center;
    } */
    .basic-info {
        justify-content:center;
        align-items: center;
        text-align: center;
        padding-bottom: 6%;
    }

    #photo {
        width: 40%;
        height: 0%;
        border-radius: 50%;
        border: black .2rem solid;
    }

    .btn-photo {
        color:black;
        font-size:4vh;
        padding-bottom: 4%;
        margin-left: 180px;
        margin-top: -40px;
    }

    .profile-photo input {
        cursor: pointer;
        z-index: 1;
    }

    #file {
        display: none;
    }

    .col-25 {
        float: left;
        width: 25%;
        margin-top: 6px;

        padding: 12px 12px 12px 0;
    }

    .col-75 {
        float: left;
        width: 75%;
        margin-top: 6px;

        padding: 12px;
        resize: vertical;
        box-shadow: 0 0 10px 2px rgba(0,0,0,0.1);
        border-radius: 5px;
        border: none;
    }

    .col-75:hover{
        border: 1px solid black;
    }

    .row::after {
        content: "";
        display: table;
        clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {

        .col-25,
        .col-75,
        input[type=submit] {
            width: 100%;
            margin-top: 0;
        }
    }

    button {
        text-decoration: none;
        color: white;

        margin-top: 2%;
        padding: 2% 2%;
        border: none;
        background-color: rgb(0, 145, 255);
        border-radius: 40px;
        width: 150px;
        font-weight: bold;
    }

    .edit-btn{
        text-align: right;

    }
    .edit-btn a {
        text-decoration: none;
        color: white;
    }

    /* order details */

    

    /* .topic-row, .data-row, .last-row{
        background-color: #d9d9d9;
    } */

    .col-40 {
        float: left;
        width: 40%;
        padding: 6px 0;
    }

    .col-20 {
        float: left;
        width: 20%;
        padding: 6px 0;
    }

    .col-10 {
        float: left;
        width: 10%;
        padding: 6px 0;
        text-align: center;
    }

    .col-30 {
        float: left;
        width: 30%;
        padding: 6px 0;
        text-align: right;
    }

    .col-60{
        float: left;
        width: 60%;
        padding: 6px 0;
        text-align: right;
    }
    /* #add-btn{
        margin-left: -12px;
    }
     */
  
    
   
    .main-topic{
        font-size:2vh;
    margin-bottom: 0.3%;
    }

    </style>
</head>
<body>

<div class="profile-details">
    <!-- Your existing profile details code -->

    <div class="profile-info">
        <div class="basic-info">
            <div class="profile-photo">
                <?php
                $profileImage = isset($_SESSION["profile_image"]) ? $_SESSION["profile_image"] : "default.jpg";
                echo "<img src='$profileImage' alt='Profile Photo' id='photo'>";
                ?>
            </div>

            <div class="btn-photo">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <input type="submit" value="Upload" name="submit">
    </form>
</div>

<div class="user">
    <div class="user-name">
        <p><?php echo $name;?></p>
    </div>
    <!-- <div class="user-id">
        <p>shenal_654</p>
    </div> -->
</div>

    </div


        </div>

        <form action="">
            <div class="mobile">
                <p class="col-25">Mobile</p>
                <p class="col-75"><?php echo $phone;?></p>
            </div>

            <!-- <div class="dob">
                <p class="col-25">Date of Birth</p>
                <p class="col-75">12-12-2001</p>
            </div> -->

            <div class="email">
                <p class="col-25">Email</p>
                <p class="col-75"><?php echo $email;?></p>
            </div>

            <div class="address">
                <p class="col-25">Address</p>
                <p class="col-50"><?php echo $address;?></p>
            </div>

            <div class="edit-btn">
                <button><a href=""><i class='bx bx-edit-alt'></i> Edit Profile</a></button>
            </div>
        </form>


    </div>

</div>

<?php
include_once 'footer.php'; // Include your footer file
?>

</body>
</html>
