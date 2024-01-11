<?php

include 'connect.php';
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

if(isset($_POST['submit'])){

    $product=$_POST['name'];
    $quantity=$_POST['quantity'];
    $descript=$_POST['description'];
    $bdescript=$_POST['bdescription'];
    $price=$_POST['price'];
    $option=$_POST['option'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_image;
    $p_image_folder_beer = 'beer/'.$p_image;
    $p_image_folder_wine = 'wine/'.$p_image;
    $p_image_folder_alchol = 'alchol/'.$p_image;

    $check=mysqli_query($conn,"SELECT * FROM items WHERE pName='$product' and pOption='$option'");

    if(mysqli_num_rows($check)>0){
        $row=mysqli_fetch_assoc($check);
        $quantity=$quantity+$row['pQuantity'];
        $id=$row['pId'];
      
        $add=mysqli_query($conn,"UPDATE items SET  pQuantity='$quantity',pbDesc='$bdescript',,pPrice='$price',pImg='$p_image' WHERE pId='$id'");
        if($add){
            if($option=='Beer'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder_beer);
                $message[]='Product add succesfully into folder_beer';
              }

            else if($option=='Wine'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder_wine);
                $message[]='Product add succesfully into folder_wine';
                
            }
            else if($option=='Alchol'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder_alchol);
                $message[]='Product add succesfully into folder_alchol';
                
            }
            else if($option=='Old stuff'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder);
                $message[]='Product add succesfully into folder_uploaded';
                
            }
            

        }
        else{
            $message[]='not updated';
        }

       
    }
    else{

    

    $insert=mysqli_query($conn,"INSERT INTO items(pName,pQuantity,pDesc,pbDesc,pPrice,pOption,pImg)
       VALUES('$product','$quantity','$descript','$bdescript','$price','$option','$p_image')") or die('query failed');

       if($insert){
            if($option=='Beer'){
                
                move_uploaded_file($p_image_tmp_name,$p_image_folder_beer);
                $message[]='Product add succesfully into folder_beer';
              }

            
            else if($option=='Wine'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder_wine);
                
                $message[]='Product add succesfully into folder_wine';
                
            }
            else if($option=='Alchol'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder_alchol);
                $message[]='Product add succesfully into folder_alchol';
                
            }
            else if($option=='Old stuff'){
                move_uploaded_file($p_image_tmp_name,$p_image_folder);
                $message[]='Product add succesfully into folder_uploaded';
                
            }

        }
        else{
            $message[]='image not uploaded';
        }
       

    } 
       



}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | Ek Bar</title>
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
            <h3>Add product</h3>
            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
             
            <form action="" method="POST" enctype="multipart/form-data">
            
      <div class="indiv">
      <span>Product name</span>
            <input type="text" name="name" class="box" placeholder="name" id="" required>
            <span>Quantity</span>
            <input type="number" name="quantity" class="box" placeholder="quantity" id="" required>
            <span>Description</span>
            <input type="text" name="description" class="box" placeholder="description" id="" required>
            <span>Brief description</span>
            <input type="text" name="bdescription" class="box" placeholder=" Brief description" id="" required>
           


      </div>

      <div class="indiv">
      <span>Price</span>
            <input type="number" min="0" name="price" class="box" placeholder="price" id="" required>

        
        <span>Catogory</span><br>
        <select id="" name="option" class="box">
        
            <option   value="Beer">Beer</option>
            <option   value="Wine">Wine</option>
            <option   value="Alchol">Alchol</option>
            <option   value="Old stuff">Old stuff</option>
        </select><br>
    
      <span>Image</span>
            <input type="file" name="p_image"  class="img-box" required>       
            
  </div>

      <input type="submit" name="submit" value="Add Product" class="btn" >
            
           
           
             
        </form>
    </div>
</body>
</html>
<?php
include_once 'footer.php';
updated
?>
