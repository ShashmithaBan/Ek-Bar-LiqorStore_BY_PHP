<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "css/.index.css">

</head>
<body>

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
}?>

<main>
<section class="top" data-aos="fade-up">
            <p class = "top-text">As Sri Lanka's premier destination for premium wines and spirits, EkBar invites you to indulge in our exquisite collection.</p>
            <div class="bgimage">
        <div class="carousel">
            <div class="carousel-slide" style="background-image: url('source/Rum');"></div>
            <div class="carousel-slide" style="background-image: url('source/Wine);"></div>
            <!-- Add more slides as needed -->
        </div>
    </div>
           
            
            <div class = start-exploring>
                <div class = left-se>
                    <img class = "img-se" src = "Source/Home-rum-collectio.png">
                    <button class = "button-se">Start Exploring</button>
                </div>
                <div class = "center-se">
                    
                    <h1>
                        From Terroir to Tasting: Unveiling the Secrets of Fine Winemaking
                    </h1>
                    <p>
                        Step into our exclusive wine sanctuary, where the world of fine wines reveals its captivating beauty. I'm Sarah, your trusted guide on this enriching odyssey. Whether you're a seasoned connoisseur or a curious newcomer, wine here transcends being just a drink; it becomes an art form. Our virtual vineyard tours transport you to breathtaking landscapes and wine regions steeped in history. You'll intimately know the influence of "terroir," the interplay of soil, climate, and grape variety that shapes every sip. We'll unravel the art of wine tasting, allowing you to discern the subtlest of notes and enrich your conversations. And as we explore the stories behind each label, you'll sip not just wine but stories, becoming part of a rich narrative.
<br><br>
                        But that's not all. We'll delve into the magic of food pairings, guiding you through the intricacies of matching flavors. Your wine journey begins here, where we raise a glass to new beginnings. With our curated content and interactive sessions, you'll embark on an extraordinary voyage that transcends wine—it's a journey of discovery, a celebration of life, and a toast to the finer things. So, together, let's explore the world of wine and savor the beauty it brings to our lives. Cheers! 🍷🌿    
                    </p>
                </div>
                <div class = "right-se">
                    <img src = "Source/welcome-351x428-v1.webp">
                </div>
            </div>
        </section>
        <section class = "best-se">
            <div class="best-title">
                <p>Best Seller</p>
            </div>
            <div class="products">
            <div class="best-box">
                
                
            <?php
         $select= "SELECT * FROM `items` WHERE pId LIMIT 6";
         $select_run = mysqli_query($conn,$select);
         if(mysqli_num_rows($select_run)>0){
            while($row=mysqli_fetch_assoc($select_run)){
      ?>
                
                <div class="best-card">
                    <div class="card">
                        <div class="card-img">
                            <?php
                            if($row['pOption'] == 'beer'){

                            ?>
                            <img src = "beer/<?=$row['pImg']?>">
                            <?php }
                            else if($row['pOption'] == 'wine'){

                                ?>
                                <img src = "wine/<?=$row['pImg']?>">
                                <?php }
                                else if($row['pOption'] == 'Alchol'){

                                    ?>
                                    <img src = "alchol/<?=$row['pImg']?>">
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
                            <a href><img src="Source/add-to-favorites.png"> </a>
                        </div>
                        </div>
                    
                                </div>
                        <?php

                        if($row['pId'] == 3){
                            echo '<br>';
                        }
                         }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>
                                  </div>
                    
                                  </div>
        </section>
    </main> 
    \

    
</body>
</html>
<?php
require_once 'footer.php';

?>