<?php

include 'components/connect.php';



session_start();
if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
if ($fetch_profile['admin_id']!=null){
   $select_admin = $conn->prepare("SELECT * FROM `providers` WHERE id = ?");
   $select_admin->execute([$fetch_profile['admin_id']]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);
   if($select_admin->rowCount() > 0){
   $_SESSION['admin_id'] = $row['id'];
      header('location:provider.php');
}
else {
   $message[] = $fetch_profile['admin_id'];
}
            }
            }
            

include 'components/plan.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $phone = $_POST['phone'];
   $phone = filter_var($phone, FILTER_SANITIZE_STRING);

   $city = $_POST['city'];
   $city = filter_var($city, FILTER_SANITIZE_STRING);

   $street = $_POST['street'];
   $street = filter_var($street, FILTER_SANITIZE_STRING);

   $street = $_POST['street'];
   $street = filter_var($street, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $bio = $_POST['bio'];
   $bio = filter_var($bio, FILTER_SANITIZE_STRING);

   $select_profil = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_profil->execute([$user_id]);
   $fetch_profil = $select_profil->fetch(PDO::FETCH_ASSOC);

   $empty_pass = '';
   $prev_pass = $fetch_profil['password'];
   $password = $_POST['password'];

   if($password == $empty_pass){
      echo '<script>alert("please enter your password to confirm")</script>';
   }
   elseif($password != $prev_pass){
      echo '<script>alert("incorrect password")</script>';
   }
   else{
    $insert_user = $conn->prepare("INSERT INTO `providers`(name,phone,email, password,city,street,bio)
    VALUES(?,?,?,?,?,?,?)");
   $insert_user->execute([$name, $phone, $email, $password, $city, $street,$bio]);
   $select_admin = $conn->prepare("SELECT * FROM `providers` WHERE email = ? AND password = ?");
   $select_admin->execute([$email, $password]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);
   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:provider.php');
      $update_profile = $conn->prepare("UPDATE `users` SET admin_id = ? WHERE id = ?");
      $update_profile->execute([$_SESSION['admin_id'], $user_id]);
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
   <title>Promote</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="style/style3.css">

</head>
<body>
<?php include 'components/header.php'; ?>


<section class="form-container">

            <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC); ?>
   <form action="" method="post">
      <h3>Promote your business</h3>
      <p>please enter the business information <p>
      <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required placeholder="enter your username" maxlength="20"  class="box">
      <input type="email" name="email" value="<?= $fetch_profile['email']; ?>" required placeholder="enter your email" maxlength="20"  class="box">
      <input type="number" name="phone" value="<?= $fetch_profile['phone']; ?>" required placeholder="enter your phone number" maxlength="20"  class="box">
      <input type="text" name="city" value="<?= $fetch_profile['city']; ?>" required placeholder="enter your city" maxlength="20"  class="box">
      <input type="text" name="street" value="<?= $fetch_profile['street']; ?>" required placeholder="enter your location" maxlength="20"  class="box">
      <input type="text" name="bio"  required placeholder="enter your bio" maxlength="20"  class="box">
      <input type="password" name="password" placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Promote" class="btn" name="submit">
   </form>

</section>   

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script src="js/script1.js"></script>
</body>
</html>