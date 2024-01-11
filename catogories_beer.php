<?php
include_once 'connect.php';
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

function filterProductsByPrice($conn, $minPrice, $maxPrice) {
    $filteredProducts = [];
    $pOption = 'Beer';

    // Prepare and execute SQL query
    $sql = "SELECT * FROM items WHERE pOption = ? AND pPrice BETWEEN ? AND ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $pOption, $minPrice, $maxPrice);
    mysqli_stmt_execute($stmt);

    // Fetch results
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $filteredProducts[] = $row;
    }

    // Close statement
    mysqli_stmt_close($stmt);

    return $filteredProducts;
}


// Set the minimum and maximum prices for filtering
$minPrice = isset($_GET['minPrice']) ? (int)$_GET['minPrice'] : 0;
$maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : PHP_INT_MAX;

// Filter products based on price
$filteredProducts = filterProductsByPrice($conn, $minPrice, $maxPrice);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "css/catogories.css">
</head>
<body>
    <section class="main">
        <div class="ptop">
            <div class="ptop-text">
            Wines
            </div>
            <div class="ptop_descript">
             <h4>Browse through the largest portfolio of wines</h4>
             <p>Whether you’re looking for a Red Wine or a White Wine, dry Merlot from Chile or a crisp Chardonnay from Italy, our online wine store in Sri Lanka has some of the best wine brands for you to choose from. Buy your favorite wine from our store and quench your thirst without stepping out!</p>
            </div>
        </div>
    <div class="pbottom">

    <div class="filter-bar">
        <form action="" method="get">
            <div class="minmax">
            <div class="min">
            <label for="minPrice">Minimum Price</label>
        <input type="number" name="minPrice" id="minPrice" value="<?= $minPrice ?>">
            </div>
        
        <div class="max">
        <label for="maxPrice">Maximum Price</label>
        <input type="number" name="maxPrice" id="maxPrice" value="<?= $maxPrice ?>">
        </div>
            </div>
        <div class="center_btn">
        <button type="submit">Filter</button>
        </div>
    </form>
        </div>
        <div class="products">
            <div class="product_box">
                
                     
                
    <?php if (empty($filteredProducts)) : ?>
        <p>No products found within the specified price range.</p>
        <?php else : ?>
        
            <?php foreach ($filteredProducts as $row) : ?>
                <div class="best-card">         
                
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
                            <div class="pcard-text">
                                <h6><?php echo $row["pOption"];?></h6>
                                <h3><?php echo $row["pName"];?></h3>
                                <h5>LKR <?php  echo $row["pPrice"];?></h5>
                            </div>
                            <div class="pcard-buton">
                            <a href = "product.php?pId=<?= $row['pId']; ?>"><button type ="submit" name = "view-product">View Product</button></a>
                                <a href><img src="Source/add-to-favorites.png"> </a>
                            </div>
                        </div>
                        
                        </div>     
                   
            <?php endforeach; ?>
        
    <?php endif; ?>
                        
                
                </div>
            </div>
        </div>
    </div>
                                    </section>
</body>
</html>
<?php
include 'footer.php';
?>