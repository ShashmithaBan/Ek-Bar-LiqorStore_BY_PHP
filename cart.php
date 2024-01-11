<?php

include 'connect.php';

session_start();


if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
} else {
    $user_id = '';
    header('location: index.php');
    exit(); // Stop script execution after the redirection
}

$message = array();

if (isset($_POST['delete'])) {
    $cart_id = $_POST['cart_id'];
    $delete_cart_item = mysqli_prepare($conn, "DELETE FROM `cart` WHERE id = ?");
    mysqli_stmt_bind_param($delete_cart_item, 'i', $cart_id);
    mysqli_stmt_execute($delete_cart_item);
    $message[] = 'Cart item deleted!';
}

if (isset($_POST['delete_all'])) {
    $delete_cart_item = mysqli_prepare($conn, "DELETE FROM `cart` WHERE user_id = ?");
    mysqli_stmt_bind_param($delete_cart_item, 'i', $user_id);
    mysqli_stmt_execute($delete_cart_item);
    $message[] = 'Deleted all items from the cart!';
}

if (isset($_POST['update_qty'])) {
    $cart_id = $_POST['cart_id'];
    $qty = filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_STRING);
    $update_qty = mysqli_prepare($conn, "UPDATE `cart` SET quantity = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_qty, 'ii', $qty, $cart_id);
    mysqli_stmt_execute($update_qty);
    $message[] = 'Cart quantity updated!';
}

$grand_total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>

<?php
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
<div class="main">
<div class="heading">
    <h3>Shopping Cart</h3>
    <p><a href="home.php">Home</a> <span>> Cart</span></p>
</div>

<!-- Shopping Cart section starts -->
<section class="products">

    

    <div class="box-container">
      <table>
        <tr>
            <th>Q.V</th>
            
            <th>Product Image</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            
            <th>Sub Total</th>
        </tr>
<tr>
        <?php
        $grand_total = 0;
        $select_cart = mysqli_prepare($conn, "SELECT * FROM `cart` WHERE user_id = ?");
        mysqli_stmt_bind_param($select_cart, 'i', $user_id);
        mysqli_stmt_execute($select_cart);
        $result = mysqli_stmt_get_result($select_cart);

        if (mysqli_num_rows($result) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($result)) {
                ?>
                <form action="" method="post" class="box">
                    <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                  <td>  <a href="product.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye" id = "eye"></a>
                    <button type="submit" class="fas fa-times" name="delete"
                            onclick="return confirm('Delete this item?');"></button></td>
                  <td> <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt=""></td>
                   <td> <div class="name"><?= $fetch_cart['name']; ?></div></td>
                    <div class="flex">
                    <td>  <div class="price"><span>$</span><?= $fetch_cart['price']; ?></div></td>
                    <td>  <input type="number" name="qty" class="qty" min="1" max="99"
                               value="<?= $fetch_cart['quantity']; ?>" maxlength="2">
                        <button type="submit" class="fas fa-edit" name="update_qty"></button></td>
                    </div>
                    <td> <div class="sub-total"> <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span>
                    </div></td>
                </form>
                </tr>
                <?php
                $grand_total += $sub_total;
                }
        } else {
            echo '<div class="msg" ><p class="empty">Your cart is empty</p></div>';
        }
        ?>
        
</table>
    </div>

    <div class="cart-total">
        <p>Cart total : <span>$<?= $grand_total; ?></span></p>
        <a href="checkout.php" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Proceed to Checkout</a>
    </div>

    <div class="more-btn">
        <form action="" method="post">
            <button type="submit" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" name="delete_all"
                    onclick="return confirm('Delete all from cart?');">Delete All
            </button>
        </form>
        
    </div>

</section>
</div>


<?php include 'footer.php'; ?>




</body>
</html>

