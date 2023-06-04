<?php


if(isset($_POST['add_to_plan'])){

   if($user_id == ''){
      header('location:login.php');
   }else{
      $offer_id = $_POST['pid'];
      $offer_id = filter_var($offer_id, FILTER_SANITIZE_STRING);
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $price = $_POST['price'];
      $price = filter_var($price, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $cat = $_POST['cat'];
      $cat = filter_var($cat, FILTER_SANITIZE_STRING);
      $day = $_POST['trip-start'];
      $day = filter_var($day, FILTER_SANITIZE_STRING);

      $check_cart_numbers = $conn->prepare("SELECT * FROM `plan` WHERE name = ? AND user_id = ?");
      $check_cart_numbers->execute([$name, $user_id]);

      if($check_cart_numbers->rowCount() > 0){
         echo '<script>alert("already added to your plan!")</script>';
      }else{
         if ($cat=='hall'){
      $start = $_POST['start'];
      $start = filter_var($start, FILTER_SANITIZE_STRING);
      $end = $_POST['end'];
      $end = filter_var($end, FILTER_SANITIZE_STRING);
      

      $numbers = $conn->prepare("SELECT * FROM `appointments` WHERE offers_id = ?
      AND day = ? and ( (start_time < ? and end_time > ?) OR (start_time < ? and end_time > ?) 
      Or ( start_time < ? and end_time > ?) Or ( start_time > ? and end_time < ?) ) ");
      $numbers->execute([$offer_id, $day, $start, $start, $end, $end, $start, $end, $start, $end]);
      if($numbers->rowCount() > 0){
         echo '<script>alert("Please choose another time this appointement is reserved")</script>';   
      }
      else{
         $insert_cart = $conn->prepare("INSERT INTO `plan`(user_id, offer_id, name, price, image,day,start_time,end_time) VALUES(?,?,?,?,?,?,?,?)");
         $insert_cart->execute([$user_id, $offer_id, $name, $price, $image,$day,$start,$end]);
         echo '<script>alert("done! check your plan")</script>';
      }
      }
         else{
            if(isset($_POST['date'])){
            $qty = $_POST['qty'];
            $qty = filter_var($qty, FILTER_SANITIZE_STRING);
            $insert_cart = $conn->prepare("INSERT INTO `plan`(user_id, offer_id, name, price, quantity, image,day) VALUES(?,?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $offer_id, $name, $price, $qty, $image,$day]);
            echo '<script>alert("done! check your plan")</script>'; 
            }
            else{
            $qty = $_POST['qty'];
            $qty = filter_var($qty, FILTER_SANITIZE_STRING);
            $insert_cart = $conn->prepare("INSERT INTO `plan`(user_id, offer_id, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
            $insert_cart->execute([$user_id, $offer_id, $name, $price, $qty, $image]);
            echo '<script>alert("done! check your plan")</script>'; 
            }
      }
   }
   }

}

?>