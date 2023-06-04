<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `plan` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `plan` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:plan.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];   

   $select_cart = $conn->prepare("SELECT * FROM `plan` WHERE id = ?");
      $select_cart->execute([$cart_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            $qq= $fetch_cart['quantity'];
            $dd= $fetch_cart['day'];
         }
         }
         if($qq!=NULL){
            $qty = $_POST['qty'];
            $qty = filter_var($qty, FILTER_SANITIZE_STRING);
            $update_qty = $conn->prepare("UPDATE `plan` SET quantity = ? WHERE id = ?");
            $update_qty->execute([$qty,$cart_id]);
            $message[] = 'plan data updated';
         }
         if($dd!=NULL){
            $date = $_POST['trip-start'];
            $date = filter_var($date, FILTER_SANITIZE_STRING);
            if($qq==NULL){
               $start = $_POST['start'];
               $start = filter_var($start, FILTER_SANITIZE_STRING);
               $end = $_POST['end'];
               $end = filter_var($end, FILTER_SANITIZE_STRING);
            $update_qty = $conn->prepare("UPDATE `plan` SET start_time = ?, end_time = ?  WHERE id = ?");
            $update_qty->execute([$start, $end, $cart_id]);
         }
            $update_qty = $conn->prepare("UPDATE `plan` SET day = ? WHERE id = ?");
            $update_qty->execute([$date, $cart_id]);
            $message[] = 'plan data updated';
         }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style2.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">Your plan</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `plan` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_images/<?= $fetch_cart['image']; ?>" alt="">
      <?php
      if($fetch_cart['quantity'] == Null){
      ?>
      <div class="flex">
      <div class="price"><?= $fetch_cart['name']; ?></div>
         <div class="name">$<?= $fetch_cart['price']; ?>/-</div>
      </div>



      <?php
      }
      else {
      ?>
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="flex">
         <div class="price">$<?= $fetch_cart['price']; ?>/-</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
      </div>

      <?php
      }
      if($fetch_cart['day'] != Null){
      ?>
      <input type="date" id="start" name="trip-start"
       value="<?php echo $fetch_cart['day'] ?>"
       min="<?php echo date('Y-m-d'); ?>" max="2030-12-31">
       <?php
       }
       ?>
      <div class="sub-total"> sub total : <span>$<?php if ( $fetch_cart['quantity']==NULL){ $sub_total = ($fetch_cart['price'] * ($fetch_cart['end_time'] - $fetch_cart['start_time']) ); }
      else $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']);
      echo $sub_total; ?>/-</span> </div>
      <?php
      if($fetch_cart['quantity'] == Null){
      ?>
      <div class="flex">
         <div class="price"><span>Start Time</span></div>
         <input type="number" name="start" class="qty" min="1" max="24" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['start_time']; ?>">
      </div>
      <div class="flex">
         <div class="price"><span>End Time</span></div>
         <input type="number" name="end" class="qty" min="1" max="24" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['end_time']; ?>">
      </div>
      <?php
       }
       ?>
      <button type="submit" class="fas fa-edit" name="update_qty"></button>
      <input type="submit" value="delete from plan" onclick="return confirm('delete this from plan?');" class="delete-btn" name="delete">
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your do not have a plan yet</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?= $grand_total; ?>/-</span></p>
      <a href="our_offers.php" class="option-btn">continue with your plan</a>
      <a href="plan.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('start planing over?');">delete your plan</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>
<?php include 'components/footer.php'; ?>
<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>

</body>
</html>