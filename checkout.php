<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['order'])){
   
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $total_products = $_POST['total_products'];
   $total_price = $_POST['total_price'];

   $check_cart = $conn->prepare("SELECT * FROM `plan` WHERE user_id = ?");
   $check_cart->execute([$user_id]);

   if($check_cart->rowCount() > 0){
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, method, total_products, total_price) VALUES(?,?,?,?)");
      $insert_order->execute([$user_id, $method, $total_products, $total_price]);
   }
      $delete_cart = $conn->prepare("DELETE FROM `plan` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      
      $message[] = 'order placed successfully!';
   }else{
      $message[] = 'your don\'t have a plan yet';
   }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="style/style2.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>your orders</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $cart_items[] = '';
         $select_cart = $conn->prepare("SELECT * FROM `plan` WHERE user_id = ?");
         $select_cart->execute([$user_id]);
         if($select_cart->rowCount() > 0){
            while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
               if($fetch_cart['quantity']== NULL){
                  $text = $fetch_cart['name'].' ('.$fetch_cart['price'].' -> '. $fetch_cart['start_time']. '-' .$fetch_cart['end_time'];
                  if($fetch_cart['day'] != NULL) $text = $text . '['.$fetch_cart['day'].']';
                  $text .= ')';
                  $cart_items[] = $text;
                  $total_products = implode($cart_items);
                  $grand_total += ( $fetch_cart['price'] * ($fetch_cart['end_time'] - $fetch_cart['start_time']) );
               }
               else{
                  $text = $fetch_cart['name'].' ('.$fetch_cart['price'].' x '. $fetch_cart['quantity'];
                  if($fetch_cart['day'] != NULL) $text = $text . '['.$fetch_cart['day'].']';
                  $text .= ')';
                  $cart_items[] = $text;
                  $total_products = implode($cart_items);
                  $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);

               }
               
      ?>
         <p> <?= $fetch_cart['name']; ?> <span>(<?php 
         if($fetch_cart['quantity']== NULL){ echo'$'.$fetch_cart['price'].'/- x '. ($fetch_cart['end_time'] - $fetch_cart['start_time']); }
         else echo'$'.$fetch_cart['price'].'/- x '. $fetch_cart['quantity']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">your cart is empty!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_products; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">grand total : <span>$<?= $grand_total; ?>/-</span></div>
      </div>

      <h3>place your orders</h3>

      <div class="flex">
         <div class="inputBox">
            <span>payment method: </span>
            <select name="method" class="box" required>
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card" disabled="true">credit card</option>
               <option value="paypal" disabled="true">paypal</option>
            </select>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>" value="place order">
   </form>

</section>


<?php include 'components/footer.php'; ?>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script.js"></script>

</body>
</html>