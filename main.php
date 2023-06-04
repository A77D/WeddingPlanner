<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};
include 'components/plan.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>main</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

 <link rel="stylesheet" href="style/style2.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-1.png" alt="">
         </div>
         <div class="content">
            <span>many choises to satisfy everyone</span>
            <h3>choose your dream wedding dress</h3>
            <a href="our_offers.php" class="btn">make your plan now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>many choises to satisfy everyone</span>
            <h3>happy guests happy wedding</h3>
            <a href="our_offers.php" class="btn">make your plan now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/home-img-3.png" alt="">
         </div>
         <div class="content">
            <span>many choises to satisfy everyone</span>
            <h3>make every moment special</h3>
            <a href="our_offers.php" class="btn">make your plan now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">shop by category</h1>

   <div class="portfolio-container">

<a href="category.php?category=hall" class="box">
   <div class="image">
      <img src="images/port-img-1.jpg" alt="">
   </div>
   <h3>wedding Hall</h3>
</a>

<a href="category.php?category=cake" class="box">
   <div class="image">
      <img src="images/port-img-2.jpg" alt="">
   </div>
   <h3>Cake</h3>
</a>

<a href="category.php?category=makeup" class="box">
   <div class="image">
      <img src="images/port-img-3.jpg" alt="">
   </div>
   <h3>Makeup</h3>
</a>

<a href="category.php?category=photographer" class="box">
   <div class="image">
      <img src="images/port-img-4.jpg" alt="">
   </div>
   <h3>Photographer</h3>
</a>

<a href="category.php?category=dress" class="box">
   <div class="image">
      <img src="images/port-img-5.jpg" alt="">
   </div>
   <h3>Dresses</h3>
</a>

<a href="category.php?category=other" class="box">
   <div class="image">
      <img src="images/port-img-6.jpg" alt="">
   </div>
   <h3>Other</h3>
</a>

</div>

</section>

<section class="home-products">

   <h1 class="heading">latest offers</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `offers` LIMIT 6"); 
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
      <input type="checkbox" id="date<?=$i?>" name="date[]" value="d">
            <label for="date">do dou want to reserve it for later?</label>
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

   <div class="swiper-pagination"></div>
   </div>
</section>

<?php include 'components\footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>