<?php

include 'components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_offer'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'uploaded_images/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = 'uploaded_images/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = 'uploaded_images/'.$image_03;

   $select_products = $conn->prepare("SELECT * FROM `offers` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      echo '<script>alert("Offer name already exists")</script>';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `offers`
      (name, details, price, category, image_01, image_02, image_03,providers_id) VALUES(?,?,?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $category, $image_01, $image_02, $image_03,$admin_id]);

      if($insert_products){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            echo '<script>alert("image is too large, please try again")</script>';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            echo '<script>alert("Offer added successfully")</script>';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `offerss` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_images/'.$fetch_delete_image['image_01']);
   unlink('uploaded_images/'.$fetch_delete_image['image_02']);
   unlink('uploaded_images/'.$fetch_delete_image['image_03']);
   $delete_product = $conn->prepare("DELETE FROM `offers` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `plan` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   header('location:offers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Offers</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style/style3.css">

</head>
<body>

<?php include 'components/header2.php'; ?>

<section class="add-products">

   <h1 class="heading">add a new offer</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>offer name (required)</span>
            <input type="text" class="box" required maxlength="100" placeholder="enter product name" name="name">
         </div>
         <div class="inputBox">
            <span>offer price (required)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>image 01 (required)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 02 (required)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 03 (required)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>category (required)</span>
            <select name="category" id="c" class="box">
               <option value="hall">hall</option>
               <option value="cake">cake</option>
               <option value="makeup">makeup</option>
               <option value="photographer">photographer</option>
               <option value="dress">dress</option>
               <option value="other">other</option>
            </select>
        </div>
         <div class="inputBox">
            <span>offer description (required)</span>
            <textarea name="details" placeholder="enter offer description" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="add offer" class="btn" name="add_offer">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">Your offers</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->prepare("SELECT * FROM `offers` WHERE providers_id = ?");
      $select_products->execute([$admin_id]);
      if($select_products->rowCount() > 0){
         while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
            
   ?>
   <div class="box">
      <img src="uploaded_images/<?= $fetch_products['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <div class="details"><span><?= $fetch_products['details']; ?></span></div>
      <div class="flex-btn">
         <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="offers.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">You did not add any offers yet!</p>';
      }
   ?>
   
   </div>
</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>   
</body>
</html>