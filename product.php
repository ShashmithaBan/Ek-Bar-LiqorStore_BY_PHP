<?php
include 'connect.php';
require 'function/add-cart.php';

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

if(isset($_GET['pId'])){
    $pId = $_GET['pId'];
    

         $query= "SELECT * FROM `items` WHERE pId = '$pId'";
         $query_run = mysqli_query($conn,$query);
         if(mysqli_num_rows($query_run)>0){
            $row=mysqli_fetch_assoc($query_run);
            $pName = $row['pName'];
            $pQuantity = $row['pQuantity'];
            $pDesc = $row['pDesc'];
            $pbDesc = $row['pbDesc'];
            $pPrice = $row['pPrice'];
            $pImg = $row['pImg'];

            
         
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "css/product.css">
</head>
<body>
   
    <div class="main">
    <form action="" method="post">
    <input type="hidden" name="pid" value="<?= $pId; ?>">
         <input type="hidden" name="name" value="<?= $pName; ?>">
         <input type="hidden" name="price" value="<?= $pPrice; ?>">
         <input type="hidden" name="image" value="<?= $pImg ?>">
        <div class="top">
            <div class="pimage">
                 <img src = "source/CULEMBORG-SWEET-RED-750ML-X-6-1.webp">
            </div>
            <div class="top-right">
            <div class="ptext">
                 <div class="name">
                    <h4><?php echo $pName ;?></h4>
                 </div>
                 <div class="price">
                      <p><span>LKR </span><?php echo $pPrice ;?></p>
                 </div>
                 <div class="bdescript">
                    <p><?php echo $pbDesc ;?></p>
                 </div>
                 <div class="stock">
                 <?php echo $pQuantity ;?> in stock
                 </div>
                 <div class="add-to-cart">
                 <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
                 <button type="submit" class="fas fa-shopping-cart" name="add_to_cart">Add to Cart</button>
                 </div>
            </div>
            </div>
        </div>
        <div class="center">
            <div class="descript-head">
                 <h4>Description</h4>
            </div>
            <div class="descript">
                <p><?php echo $pDesc ;?><p>
            </div>
        </div>
        </form>
        <div class="bottom">
            <div class="bottom_head">
                <p>Related Products</p>
            </div>
            <div class="best-card">
                
                <?php
             $select= "SELECT * FROM `items` WHERE pId LIMIT  3 ,6";
             $select_run = mysqli_query($conn,$select);
             if(mysqli_num_rows($select_run)>0){
                while($row=mysqli_fetch_assoc($select_run)){
          ?>
                    
    
             <div class="card">
                            <div class="card-img">
                                <?php
                                if($row['pOption'] == 'beer'){
    
                                ?>
                                <img src = "Beer/<?=$row['pImg']?>">
                                <?php }
                                else if($row['pOption'] == 'wine'){
    
                                    ?>
                                    <img src = "Wine/<?=$row['pImg']?>">
                                    <?php }
                                    else if($row['pOption'] == 'beer'){
    
                                        ?>
                                        <img src = "Alchol/<?=$row['pImg']?>">
                                        <?php }
                                        ?>
                            </div>
                            <div class="card-text">
                                <h6><?php echo $row["pOption"];?></h6>
                                <h3><?php echo $row["pName"];?></h3>
                                <h5>LKR <?php  echo $row["pPrice"];?></h5>
                            </div>
                            <div class="card-buton">
                                <a href = "product.php?pId=<?= $row['pId']; ?>"><button type ="submit" name = "view-product">View Product</button></a>
                                <a href = ""><img src="Source/add-to-favorites.png"> </a>
                            </div>
                            </div>
                    
                    
                        
                        
                            
                            <?php
                             }
             }else{
                echo '<p class="empty">no products added yet!</p>';
             }
          ?></div>
                        
                </div>
        </div>
    </div>
    
    
</body>
</html>
<?php
         }
        }
        
include_once 'footer.php';
?>