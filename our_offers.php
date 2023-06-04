<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
include 'components/plan.php';

if(isset($_POST['sort'])){
   $sort = $_POST['sort'];
   $sort = filter_var($sort, FILTER_SANITIZE_STRING);
}
else{
   $sort = 'ASC';
   $sort = filter_var($sort, FILTER_SANITIZE_STRING);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>offers</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="style/style2.css">
</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="products">

<h1 class="heading">latest offers</h1>

<form action="" method="post">
   <select name='sort' onchange="this.form.submit()" class="">
    <option value='ASC' <?php if($sort=='ASC') echo "selected" ?> > Price Low to High </option>
    <option value='DESC'<?php if($sort=='DESC') echo "selected" ?> > Price High to Low </option>
    </select>
</form>

   <div class="box-container">

   <?php
   if($sort=='DESC'){
      $select_products = $conn->prepare("SELECT * FROM `offers` ORDER BY price DESC"); 
   }
   else{
      $select_products = $conn->prepare("SELECT * FROM `offers` ORDER BY price ASC"); 
   }
     $select_products->execute();
     if($select_products->rowCount() > 0){
      $i=0;
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
         $i+=1;
         if ($fetch_product['category']=='hall'){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="cat" value="<?= $fetch_product['category']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_images/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="flex">
      <div class="price"><?= $fetch_product['name']; ?></div>
         <div class="name" style="float:right" ><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
      </div>
      <input type="submit" value="add to plan" class="btn" name="add_to_plan">
      <input class = "btn" type="date" id="s" name="trip-start"
       value="<?php echo date('Y-m-d'); ?>"
       min="<?php echo date('Y-m-d'); ?>" max="2030-12-31">
       <br>
       <div class="flex">
         <div class="price"><span>Start Time</span></div>
         <input type="number" name="start" class="qty" min="1" max="24" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <div class="flex">
         <div class="price"><span>End Time</span></div>
         <input type="number" name="end" class="qty" min="1" max="24" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      </form>
   <?php
      }
      else{
         ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <input type="hidden" name="cat" value="<?= $fetch_product['category']; ?>">
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_images/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="add to plan" class="btn" name="add_to_plan">
      <span class="name">Reserve it for later?</span>
      <input type="checkbox" id="date<?=$i?>" name="date[]" value="d">
            <input class = "btn" type="date" style="display:none;"  id="start<?=$i?>" name="trip-start"
       value="<?php echo date('Y-m-d'); ?>"
       min="<?php echo date('Y-m-d'); ?>" max="2030-12-31">
   </form>
   <script>

const date<?=$i?> = document.getElementById("date<?=$i?>");
          const start<?=$i?> = document.getElementById("start<?=$i?>");
          date<?=$i?>.addEventListener("change", function(){
              if(date<?=$i?>.checked){
                  start<?=$i?>.style.display = "block";
              }else{
                  start<?=$i?>.style.display = "none";
              }
            });
   </script>
   <?php
      }
      }
   }
   else{
      echo '<p class="empty">no offers found!</p>';
   }
   ?>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>

</body>
</html>