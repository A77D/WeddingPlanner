<?php
include 'components\connect.php';

session_start();


if(isset($_POST['send'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $phone = $_POST['phone'];
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password = $_POST['password'];
   $city = $_POST['city'];
   $street = $_POST['street'];
   
   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      echo '<script>alert("This email is already registered please log in")</script>';
   }
   else{   
         $insert_user = $conn->prepare("INSERT INTO `users`(name,phone,email, password,city,street)
          VALUES(?,?,?,?,?,?)");
         $insert_user->execute([$name, $phone, $email, $password, $city, $street]);
         $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
         $select_user->execute([$email, $password]);
         $row = $select_user->fetch(PDO::FETCH_ASSOC);
      
         if($select_user->rowCount() > 0){
            $_SESSION['user_id'] = $row['id'];
            header('location:home.php');
         }
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>SignUp</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style/style1.css">

</head>
<body>
   
<div class="container">
<section class="contact">
         
   <h1 class="heading">Sign Up</h1>
   <form action="" method="post">
      <div class="flex">

         <div class="inputBox">
            <span>Your Name</span>
            <input type="text" placeholder="Enter your username" name="name" required>
         </div>

         <div class="inputBox">
            <span>Your Number</span>
            <input type="number" placeholder="Enter your phone number" name="phone" required>
         </div>

         <div class="inputBox">
            <span>Your Email</span>
            <input type="email" placeholder="Enter your email" name="email" required>
         </div>         

         <div class="inputBox">
            <span>Your Password</span>
            <input type="password" placeholder="Create a new password" name="password" 
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
            title="Must contain at least one number and one uppercase and lowercase letter, 
            and at least 8 or more characters" 
            required>
         </div>

         <div class="inputBox">
            <span>Your City</span>
            <input type="text" placeholder="Enter your city" name="city" required>   
         </div>

         <div class="inputBox">
            <span>Your Location</span>
            <input type="text" placeholder="Enter your spesefic street and location" name="street" required>
         </div>

      </div>
      <br>
      <div class = "togswitch">
            <label>If you have an acount already please</label>
            <a href="login.php">click here</a>
         </div>
      <br>
      <input type="submit" value="Signup" name="send" class="btn">
      </form>

</section>
</div>