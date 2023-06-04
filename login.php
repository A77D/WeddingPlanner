<?php

include 'components\connect.php';

session_start();
if(isset($_POST['login'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $password =$_POST['password'];
   $password = filter_var($password, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select_user->execute([$email, $password]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $_SESSION['user_id'] = $row['id'];
      header('location:home.php');
   }else{
      $select_admin = $conn->prepare("SELECT * FROM `providers` WHERE email = ? AND password = ?");
      $select_admin->execute([$email, $password]);
      $row = $select_admin->fetch(PDO::FETCH_ASSOC);
      if($select_admin->rowCount() > 0){
         $_SESSION['admin_id'] = $row['id'];
         header('location:provider.php');
      }
         else{
      echo '<script>alert("Wrong email or password, try again")</script>';
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
   <title>Login</title>

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
   <h1 class="heading">Login</h1>

   <form action="" method="post">

      <div class="flex">
         <div clas="left">
<br><br>
            <div class="inputBox">
               <span>your email</span>
               <input type="email" placeholder="enter your email" name="email" required>
            </div>
<br><br>
            <div class="inputBox">
               <span>Your Password</span>
               <input type="password" placeholder="enter your number" name="password" required>
            </div>
<br>
      <input type="submit" value="Login" name="login" class="btn">
<br><br><br>
            <div class = "togswitch">
               <label>If you don't have an account yet please</label>
               <a href="signup.php">click here</a>
            </div>
<br><br>
            <a href="home.php" class="btn">Enter as a Guest</a>

         </div>
         <div class="right">
            <img src="images/LoginRight.png" alt="login" width="500" height="500">
         </div>
      </div>
   </form>
</section>
</div>